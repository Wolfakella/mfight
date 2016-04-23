<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Duel;
use App\Champ;
use App\Type;
use App\Http\Requests;

class DuelsController extends Controller
{
	public function show($id)
	{
		$duel = Duel::findOrFail($id);
		$history = Duel::whereIn('player1_id', [$duel->player1_id, $duel->player2_id])
						->whereIn('player2_id', [$duel->player1_id, $duel->player2_id])
						->orderBy('time', 'DESC')
						->get();
		$history->shift();
		return view('duels.show', compact('duel', 'history'));
	}
	public function create($champ_id)
	{
		$champ = Champ::findOrFail($champ_id);
		$types = Type::all();
		$players = $champ->users()->wherePivot('status', 'LIKE', 'Игрок')->orderBy('surname', 'ASC')->get();
		$situations = $champ->situations()->get();
		$duel = new Duel;
		
		return view('duels.create', compact('champ', 'types', 'players', 'situations', 'duel'));
	}
	
    public function edit($id)
    {
    	$duel = Duel::findOrFail($id);
    	//$champ = Champ::findOrFail($duel->champ_id);
    	$types = Type::all();
    	$champ = $duel->champ;
    	$players = $duel->champ
    					->users()
    					->wherePivot('status', 'LIKE', 'Игрок')
    					->orderBy('surname', 'ASC')
    					->get();
    	$situations = $duel->champ->situations()->get();
    	//dd( $duels );
    	return view('duels.edit', compact('champ', 'types', 'players', 'situations', 'duel'));
    }
    
    public function update(Request $request, $id)
    {
    	$duel = Duel::findOrFail($id);
    	$duel->fill($request->except(['_token', '_method']));
    	$duel->save();
    	return redirect()->route('champ.show', [$request->input('champ_id')]); 
    }
    
    public function store(Request $request)
    {
    	$duel = Duel::create($request->except(['_token']));
    	return redirect()->route('champ.show', [$request['champ_id']]);
    }
    
    public function delete($id)
    {
    	Duel::destroy($id);
    	return redirect()->back();
    }
}
