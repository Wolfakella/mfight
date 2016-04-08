<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Situation;
use Carbon\Carbon;

class ExpressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $situations = Situation::whereNull('roles')->where('id', '>', 0)->orderBy('created_at', 'desc')->paginate(15);

        return view('situations.index', compact('situations'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
    	return view('express.create')->withBack(app('Illuminate\Routing\UrlGenerator')->previous());
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
    
    	return view('express.edit', compact('situation'));
    }
    
    public function year($year)
    {
    	$situations = Situation::whereNull('roles')->whereBetween('created_at', [ Carbon::createFromDate($year, 0, 0), Carbon::createFromDate($year+1, 0, 0)])->orderBy('created_at', 'desc')->get();

        return view('situations.list', compact('situations'));
    }
}
