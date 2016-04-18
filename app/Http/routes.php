<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
	return view('welcome');
});

Route::auth();

//Route::get('/home', 'HomeController@index');
Route::controller('home', 'HomeController');

Route::group(['middleware' => ['role:admin']], function () {
	Route::get('express/{id}/edit', 'ExpressController@edit')->name('express.edit');
	Route::get('situations/{id}/edit', 'SituationsController@edit')->name('situations.edit');
	Route::patch('situations/{id}', 'SituationsController@update')->name('situations.update');
	Route::delete('situations/{id}', 'SituationsController@destroy')->name('situations.destroy');
	Route::resource('users', 'UsersController');
});

Route::group(['middleware' => ['web', 'auth']], function() {
	Route::get('situations/create', 'SituationsController@create')->name('situations.create');
	Route::get('express/create', 'ExpressController@create')->name('express.create');
	Route::post('situations', 'SituationsController@store')->name('situations.store');
	Route::get('cart/print', 'CartController@output')->name('cart.print');
});

Route::group(['middleware' => ['web']], function () {
	Route::get('situations', 'SituationsController@index')->name('situations.index');
	Route::get('situations/search', 'SituationsController@search')->name('situations.search');
	Route::get('situations/{id}', 'SituationsController@show')->name('situations.show');
	Route::get('situations/year/{date?}', ['as' => 'situations.year', 'uses' => 'SituationsController@year']);
	Route::get('express/year/{year?}', 'ExpressController@year')->name('express.year');
	Route::get('express/index', 'ExpressController@index')->name('express.index');
	Route::controller('cart', 'CartController');
	Route::get('champs/{id}', 'ChampsController@show')->name('champ.show');
	Route::get('champs/{id}/players', 'ChampsController@players');
	Route::get('champs/{champ_id}/players/{user_id}/{status}', 'ChampsController@addplayer');
	Route::get('champs/{champ_id}/remove/{user_id}', 'ChampsController@removeplayer');
	Route::any('champs/{id}/situations', 'ChampsController@situations');
	Route::get('champs/{champ_id}/situations/{situation_id}', 'ChampsController@addsituation');
	Route::get('champs/{champ_id}/situationremove/{situation_id}', 'ChampsController@removesituation');
	Route::delete('champs/{id}', 'ChampsController@remove');
	Route::get('champs/{id}/newduel', 'ChampsController@newduel');
	Route::post('champs/{id}/newduel', 'ChampsController@storeduel');
	Route::delete('champs/{id}/removeduel/{duel_id}', 'ChampsController@removeduel');

	Route::controller('champs', 'ChampsController');

	//	Route::get('situations/competition/{year}/{competition?}', 'SituationsController@competition')->name('situations.competition');
});

