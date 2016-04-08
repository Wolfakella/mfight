<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\GetSituationsJob;
use GuzzleHttp\Client;
use App\Situation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SituationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $situations = Situation::whereNotNull('roles')->where('id', '>', 0)->orderBy('created_at', 'desc')->paginate(15);

        return view('situations.index', compact('situations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('situations.create')->withBack(app('Illuminate\Routing\UrlGenerator')->previous());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['match' => 'required', 'body' => 'required', ]);

        $request->body = htmlentities($request->body);
        Situation::create($request->all());

        Session::flash('flash_message', 'Situation added!');

        return redirect('situations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $situation = Situation::findOrFail($id);
        
        $situation->body = html_entity_decode($situation->body);

        return view('situations.show', compact('situation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $situation = Situation::findOrFail($id);

        return view('situations.edit', compact('situation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['match' => 'required', 'body' => 'required', ]);

        $situation = Situation::findOrFail($id);
        $situation->update($request->all());

        Session::flash('flash_message', 'Situation updated!');

        return redirect('situations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Situation::destroy($id);

        Session::flash('flash_message', 'Situation deleted!');

        return redirect('situations');
    }
    
    public function year($year)
    {
    	$situations = Situation::whereNotNull('roles')->whereBetween('created_at', [ Carbon::createFromDate($year, 0, 0), Carbon::createFromDate($year+1, 0, 0)])->orderBy('created_at', 'desc')->get();

        return view('situations.list', compact('situations'));
    }
    
    public function competition($year, $competition)
    {
    	$data = array();
    	$matches = array();
    	$client = new Client();
    	
    	$response = $client->request(
    			'GET',
    			"http://www.poedinki.ru/competitions/$year/$competition/situations"
    			);
    	//$text = iconv('cp1251', 'utf-8', $response->getBody());
    	$text = $response->getBody();
    	
    	$pattern = "@<h2><a name=\"\d+\"></a>\d+\.&nbsp;(.*)</h2>@U";
    	preg_match_all($pattern, $text, $matches);
    	$i = 0;
    	foreach($matches[1] as $match)
    	{
    		$data[$i]['title'] = iconv('cp1251', 'utf-8', $match);
    		$data[$i]['link'] = "http://www.poedinki.ru/competitions/$year/$competition/situations/#".($i+1);
    		//$data[$i]['created_at'] = Carbon::create($year, null, null, null, null, null);
    		$i++;
    	}
    	
    	$pattern = "^class=\"Situation\">(.*)</div>^Us";
    	preg_match_all($pattern, $text, $matches);
    	$i = 0;
    	foreach($matches[1] as $match) $data[$i++]['body'] = iconv('cp1251', 'utf-8', $match);
    	
		foreach($data as $record)
		{
			$situation = Situation::firstOrCreate(['title' => $record['title']]);
			$situation->body = $record['body'];
			$situation->link = $record['link'];
			$time = Carbon::create($year, null, null, null, null, null);
			if($situation->created_at > $time) $situation->created_at = $time;
			$situation->save();
		}
    	//return dd($response);http://www.poedinki.ru/competitions/2012/.*<div class=\"Situation\">(.*)</div>
    	return dd(Situation::all());
    }
}
