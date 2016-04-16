<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Champ extends Model
{
	protected $fillable = [
			'title',
	];
	
	public function users()
	{
		return $this->belongsToMany('App\User')->withPivot('status');
	}
	
	public function situations()
	{
		return $this->belongsToMany('App\Situation');
	}
}
