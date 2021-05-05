<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');
Route::get('userImage/{path}', 'UsersController@userImage');

Route::group(['middleware' => 'auth:api'], function() {
   	//User routes
	Route::post('/logout', 'AuthController@logout');
	Route::get('loggedUser/{email}', 'UsersController@showLogged');
	Route::post('/user/update/{user}', 'UsersController@update');//should be put type, but put method not support blob columns.

	//Searches routes
	Route::post('search', 'SearchesController@store');
	Route::get('search/{search}', 'SearchesController@show');
	Route::get('searches/{user}', 'SearchesController@index');
	Route::get('recent/searches/{user}', 'SearchesController@recentSearches');

	//Alerts routes
	Route::post('alert', 'AlertsController@store');
	Route::get ('alert/{alert}', 'AlertsController@show');
});