<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champ;
use App\User;
use App\Http\Requests;

class ChampsController extends Controller
{
    public function getIndex($id)
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
    	//dd( $players );
    	return view('champs.show', ['champ' => $champ, 'players' => $players, 'judges' => $judges]);
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
}
