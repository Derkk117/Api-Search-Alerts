<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');

Route::group(['middleware' => 'auth:api'], function() {
   	//User routes
	Route::post('/logout', 'AuthController@logout');
	Route::get('loggedUser/{email}', 'UsersController@showLogged');

	//Searches routes
	Route::post('search', 'SearchesController@store');
});