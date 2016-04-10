<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champ;
use App\Http\Requests;

class ChampsController extends Controller
{
    public function getIndex()
    {
    	$champs = Champ::all();
    	//dd( $champs );
    	return view('champs.index', compact('champs'));
    }
    
    public function remove($id)
    {
    	dd("This is delete champs $id");
    }
}
