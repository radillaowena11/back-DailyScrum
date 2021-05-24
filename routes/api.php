<?php

use Illuminate\Http\Request;

Route::post('login', 'UserController@login'); //do login
Route::post('register','UserController@register'); //create petugas


Route::group(['middleware' => ['jwt.verify']], function () {
	Route::get('login/check', "UserController@LoginCheck");
	Route::post('logout', "LoginController@logout");
    
	Route::get('dailyScrum/{id}', "dailyScrumController@index"); //read poin
	Route::post('dailyScrum', 'dailyScrumController@store'); //create poin
	Route::delete('dailyScrum/{id}', "dailyScrumController@delete"); //delete poin

});