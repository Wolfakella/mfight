<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission as HasRoleAndPermissionTrait;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
	use HasRoleAndPermissionTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    	'middlename',
    	'surname',
    	'phone',
    	'email',
    	'position',
    	'company',
    	'about',
    	'login',
    	'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'login'
    ];
    
    protected $appends = [
    	'name_surname'	
    ];
    
    public function getNameSurnameAttribute()
    {
    	return $this->attributes['name'] . ' ' . $this->attributes['surname']; 
    }
    
    public function champs()
    {
    	return $this->belongsToMany('App\Champ')->withPivot('status');
    }
    
    public function duels()
    {
    	return $this->hasMany('App\Duel', 'id', 'player1_id');
    }
    
    public function duels2()
    {
    	return $this->hasMany('App\Duel', 'id', 'player2_id');
    }
}
