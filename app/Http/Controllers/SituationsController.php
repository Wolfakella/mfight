<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\GetSituationsJob;
use GuzzleHttp\Client;
use App\Situation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        if(Cache::has('cart') && Cache::get('cart')->has($id)) $inCart = 1;
        else $inCart = 0;
        
        return view('situations.show', compact('situation'))->withcart($inCart);
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
    
    public function year($date = 2016)
    {
    	$situations = Situation::whereNotNull('roles')->whereBetween('created_at', [ Carbon::createFromDate($date, 0, 0), Carbon::createFromDate($date+1, 0, 0)])->orderBy('created_at', 'desc')->get();

        return view('situations.list', compact('situations'));
    }
}
