<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champ;
use App\User;
use App\Situation;
use App\Type;
use App\Duel;
use App\Http\Requests;

class AjaxController extends Controller
{
	public function getIndex()
	{
		return json_encode('Hello, world!');
	}
	public function getBrackets($champ_id)
	{
		$champ = Champ::findOrFail($champ_id);
		$duels = $champ	->duels()
						->with('player1', 'player2', 'type')
						->select('id','player1_id','player2_id', 'type_id', 'result1', 'result2', 'order')
						->where('type_id', '>', 1)
						->orderBy('created_at','DESC')
						->get();
		return response()->json($duels);
	}
}
