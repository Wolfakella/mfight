<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use App\User;
use App\Duel;
use App\Situation;
use App\Champ;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$champs = Champ::select('id', 'title')->orderBy('created_at', 'DESC')->get();
    	$duels = Duel::where('video', 'NOT LIKE', '')->get()->random(3);
    	$players = User::all()->random(5);
    	$situation = Situation::select('id','title', 'body')->get()->random();
    	//dd( $situation );
        return view('welcome', compact('champs', 'duels', 'players', 'situation'));
    }
    
    public function anyProcess()
    {
    	$user = User::findOrFail(1);

		$user->attachRole(1);
    }
}
