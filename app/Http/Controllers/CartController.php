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
        $situations = Cache::get('cart');

        return view('cart.index')->withSituations($situations->all());
    }
    
    public function getAdd($id)
    {
    	$situation = Situation::find($id);
    	if(Cache::has('cart'))
    	{
    		$situations = Cache::get('cart');
    		$situations->push($situation);
    		Cache::put('cart', $situations, 5);
    	}
    	else
    	{
    		$situations = new Collection();
    		$situations->push($situation);
    		Cache::add('cart', $situations, 5);
    	}
    	return view('cart.index')->withSituations($situations->all());
    }
    
    public function getRemove($id)
    {
    	$situation = Situation::find($id);
    	if(Cache::has('cart'))
    	{
    		$situations = Cache::get('cart');
    		$situations->pull($situation);
    		Cache::put('cart', $situations, 5);
    	}
    	return view('cart.index')->withSituations($situations->all());
    }
}
