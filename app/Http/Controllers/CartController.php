<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests;
use App\Situation;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function anyIndex()
    {
    	if(Cache::has('cart'))
    	{
    		$situations = Cache::get('cart');
    		return view('cart.index')->withSituations($situations->all());
    	}
    	return view('cart.index');
    }
    
    public function getAdd($id)
    {
    	$situation = Situation::find($id);
    	if(Cache::has('cart'))
    		$situations = Cache::get('cart');
    	else
    		$situations = new Collection();
    	
    	$situations->put($situation->id, $situation);
    	Cache::forever('cart', $situations);
    	return redirect()->back();
    }
    
    public function getRemove($id)
    {
    	if(Cache::has('cart'))
    	{
    		$situations = Cache::get('cart');
    		$temp = $situations->forget($id);
    		Cache::forever('cart', $situations);
    	}
    	return redirect('cart');
    }
    public function getFlush()
    {
    	if(Cache::has('cart')) Cache::forget('cart');
    	return redirect('cart');
    }
    public function output()
    {
    	if(Cache::has('cart'))
    	{
    		$situations = Cache::get('cart');
    		return view('cart.print')->withSituations($situations->all());
    	}
    	return view('cart.index');
    }
}
