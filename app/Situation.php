<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Situation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'situations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'link'];
    
    public function champs()
    {
    	return $this->belongsToMany('App\Champ');
    }
    
    public static function search($query = '', $year = 0, $type = 0)
    {
    	$result = Situation::query();
    	if($query) $result = $result->where('title', 'LIKE', '%'.$query.'%');
    	if($year) $result = $result->whereBetween('created_at', [ Carbon::createFromDate($year, 0, 0), Carbon::createFromDate($year+1, 0, 0)]);
    	if ($type)
    		switch($type)
    		{
    			case '1': $result = $result->whereNull('roles');
    			break;
    			case '2': $result = $result->whereNotNull('roles');
    			break;
    		}
    	$result = $result->orderBy('created_at', 'desc')->get();
    	return $result;
    }
    
}
