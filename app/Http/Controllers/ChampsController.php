<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champ;
use App\User;
use App\Situation;
use App\Type;
use App\Duel;
use App\Http\Requests;

class ChampsController extends Controller
{
    public function index()
    {
    	$champs = Champ::all();
    	//dd( $id );
    	return view('champs.index', compact('champs'));
    }
    
    public function show($id)
    {
    	$champ = Champ::findOrFail($id);
    	$players = $champ->users()->wherePivot('status', 'LIKE', 'Игрок')->get();
    	$judges = $champ->users()->wherePivot('status', 'LIKE', 'Судья')->get();
    	$situations = $champ->situations()->get();
    	$duels = $champ->duels()->orderBy('created_at','DESC')->get();
    	//dd( $duels );
    	return view('champs.show', [
    			'champ' => $champ, 
    			'players' => $players, 
    			'judges' => $judges, 
    			'situations' => $situations,
    			'duels' => $duels
    	]);
    }
    
    public function remove($id)
    {
    	dd("This is delete champs $id");
    }
    
    public function players($champ_id)
    {
    	$champ_users = Champ::find($champ_id)->users()->get();
    	$users = User::all();
    	return view('champs.players', ['users' => $users, 'champ_users' => $champ_users]);
    }
    public function addplayer($champ_id, $user_id, $status)
    {
    	$champ = Champ::find($champ_id);
    	$champ->users()->attach($user_id, ['status' => ($status == 1 ? 'Игрок' : 'Судья')]);
    	return redirect()->back();
    }
    public function removeplayer($champ_id, $user_id)
    {
    	$champ = Champ::find($champ_id);
    	$champ->users()->detach($user_id);
    	return redirect()->back();
    }
    
    public function situations($champ_id, Request $request)
    {
    	$champ_situations = Champ::find($champ_id)->situations()->get();
    	$situations = Situation::search($request['query'], $request['year'], $request['t'])->select('id', 'title', 'created_at')->paginate(15);
    	//dd( $situations );
    	return view('champs.situations', compact('champ_situations','situations','champ_id'))->with($request->only('query','year','t'));
    }
    public function addsituation($champ_id, $situation_id)
    {
    	$champ = Champ::find($champ_id);
    	$champ->situations()->attach($situation_id);
    	return redirect()->back();
    }
    public function removesituation($champ_id, $situation_id)
    {
    	$champ = Champ::find($champ_id);
    	$champ->situations()->detach($situation_id);
    	return redirect()->back();
    }
    
    public function brackets()
    {
    	return view('champs.brackets');
    }
}
