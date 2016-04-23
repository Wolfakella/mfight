<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\GetSituationsJob;
use GuzzleHttp\Client;
use App\Situation;
use Illuminate\Http\Request;
use Cookie;
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
        $situations = Situation::select('id', 'title', 'created_at')
        							->orderBy('created_at', 'desc')
        							->paginate(15);
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
        $this->validate($request, ['title' => 'required', 'body' => 'required', 'link' => 'required']);

        $request->body = htmlentities($request->body);
        Situation::create($request->all());

        Session::flash('flash_message', 'Situation added!');

        return redirect()->route('situations.show', [$id]);
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
        //dd( Cookie::get('cart') );
		//dd( array_search("3331", Cookie::get('cart')) );
        if(
        		Cookie::has('cart') && 
        		count(Cookie::get('cart')) > 0 &&
        		array_search($situation->id, Cookie::get('cart')) !== false        		
        ) $inCart = 1;
        else $inCart = 0;
        
        $history = $situation->duels;
        
        return view('situations.show', compact('situation', 'history'))->withcart($inCart);
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
    	$this->validate($request, ['title' => 'required', 'body' => 'required', 'link' => 'required']);

        $situation = Situation::findOrFail($id);
        $situation->update($request->all());

        Session::flash('flash_message', 'Situation updated!');

        return redirect()->route('situations.show', [$id]);
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
    
    public function search(Request $request)
    {
    	$situations = Situation::search($request['query'], $request['year'], $request['t'])->paginate(15);
    	return view('situations.index', compact('situations'))->with($request->only('query', 'year', 't'));
    }
}
