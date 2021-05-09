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
	Route::get('searches/{user}', 'SearchesController@showSearches');
	Route::get('recent/searches/{user}', 'SearchesController@recentSearches');
	Route::put('search/{search}', 'SearchesController@update');
	Route::delete('search/{search}', 'SearchesController@destroy');

	//Alerts routes
	Route::post('alert', 'AlertsController@store');
	Route::get('alert/{search}', 'AlertsController@show');
	Route::get('alertId/{search}', 'AlertsController@getAlertId');
	Route::put('alert/{search}', 'AlertsController@update');

	//Search_Instances routes
	Route::post('sInstance', 'SearchInstanceController@store');
	Route::put('sInstance/{searchInstance}', 'SearchInstanceController@update');
});