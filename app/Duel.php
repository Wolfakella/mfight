<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    protected $fillable = [
    		'champ_id',
    		'situation_id',
    		'player1_id',
    		'player2_id',
    		'result1',
    		'result2',
    		'type_id',
    		'time'
    ];
    
    public function player1()
    {
    	return $this->belongsTo('App\User', 'player1_id');
    }
    
    public function player2()
    {
    	return $this->belongsTo('App\User', 'player2_id');
    }
    
    public function champ()
    {
    	return $this->belongsTo('App\Champ');
    }
    
    public function situation()
    {
    	return $this->belongsTo('App\Situation');
    }
    
    public function type()
    {
    	return $this->belongsTo('App\Type');
    }
}
