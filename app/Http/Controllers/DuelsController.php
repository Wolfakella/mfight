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
		//dd( $duel );
		return view('duels.show')->withDuel($duel);
	}
	public function create($champ_id)
	{
		$champ = Champ::findOrFail($champ_id);
		$types = Type::all();
		$players = $champ->users()->wherePivot('status', 'LIKE', 'Игрок')->orderBy('surname', 'ASC')->get();
		$situations = $champ->situations()->get();
		
		return view('duels.edit', compact('champ', 'types', 'players', 'situations'));
	}
	
    public function edit($id)
    {
    	$duel = Duel::findOrFail($id);
    	//$champ = Champ::findOrFail($duel->champ_id);
    	$types = Type::all();
    	$players = $duel->champ
    					->users()
    					->wherePivot('status', 'LIKE', 'Игрок')
    					->orderBy('surname', 'ASC')
    					->get();
    	$situations = $duel->champ->situations()->get();
    	//dd( $duels );
    	return view('duels.edit', [
    			'champ' => $champ,
    			'types' => $types,
    			'players' => $players,
    			'situations' => $situations
    	]);
    }
    
    public function store(Request $request)
    {
    	$duel = Duel::firstOrCreate($request->except(['_token', '_method']));
    	return redirect()->route('champ.show', [$request['champ_id']]);
    }
    
    public function delete(Request $request)
    {
    	Duel::destroy($request['duel_id']);
    	return redirect()->back();
    }
}
