<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Cookie;
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
    	if(Cookie::has('cart'))
    	{
    		$IDs = Cookie::get('cart');
    		$situations = Situation::whereIn('id', $IDs)->get();
    		return view('cart.index')->withSituations($situations);
    	}
    	return view('cart.index');
    }
    
    public function getAdd($id)
    {
    	if(Cookie::has('cart') && Situation::find($id)->exists())
    			$situations = Cookie::get('cart');
    	else 
    			$situations = array();

    	if(array_search($id, $situations) === false) array_push($situations, $id);
    	
    	return redirect()->back()->withCookie(cookie()->forever('cart', $situations));
    }
    
    public function getRemove($id)
    {
    	if(Cookie::has('cart'))
    	{
    		$situations = Cookie::get('cart'); 
    		$key = array_search($id, $situations);
    		if($key !== false) array_pull($situations, $key);
    		if(count($situations))
    				return redirect('cart')->withCookie(cookie()->forever('cart', $situations));
    		else
    				return redirect('cart')->withCookie(cookie()->forget('cart'));
    	}
    	else return redirect('cart');
    }
    public function getFlush()
    {
    	return redirect('cart')->withCookie(cookie()->forget('cart'));
    }
    public function output(Request $request)
    {
    	if(Cookie::has('cart'))
    	{
    		$IDs = Cookie::get('cart');
    		$situations = Situation::whereIn('id', $IDs)->get();
    		return view('cart.print')->withSituations($situations);
    	}
    	else return view('cart.index');
    }
}
