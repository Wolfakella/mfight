<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Duel;
use App\Champ;
use App\Type;
use App\Custom\Rating;

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
    	$duel->fill($request->except(['_token']));

    	$duel->save();
    	if($duel->result1 > $duel->result2)
    	{
    		$duel->player1->rating = Rating::getWinRating($duel->rating1, $duel->rating2);
    		$duel->player2->rating = Rating::getLoseRating($duel->rating1, $duel->rating2);
    	}
    	else
    	{
    		$duel->player1->rating = Rating::getLoseRating($duel->rating2, $duel->rating1);
    		$duel->player2->rating = Rating::getWinRating($duel->rating2, $duel->rating1);
    	}
    	$duel->player1->save();
    	$duel->player2->save();

    	return redirect()->route('champ.show', [$request->input('champ_id')]); 
    }
    
    public function store(Request $request)
    {
    	$duel = new Duel();
    	$duel->fill($request->except(['_token']));
    	$duel->rating1 = $duel->player1->rating;
    	$duel->rating2 = $duel->player2->rating;
    	
    	$duel->save();
    	return redirect()->route('champ.show', [$request['champ_id']]);
    }
    
    public function delete($id)
    {
    	Duel::destroy($id);
    	return redirect()->back();
    }
}
