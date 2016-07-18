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
Route::get('/login',function(){
	return view('auth/login');
});
Route::get('/register',function(){
	return view('auth/register');
});
Route::auth();

Route::get('/home', 'HomeController@index');
Route::singularResourceParameters();
Route::group(['prefix'=>'/api/v1','namespace'=>'Api','middleware'=>['api']],
		function()
{
	//login	
	//Route::post('auth/login',[
	//	'as'=>'login',
	//	'uses'=>'AuthController@login'
	//	]);
	//logout
	//Route::post('auth/logout',[
	//	'as'=>'logoout',
	//	'uses'=>'AuthController@logout'
	//	]);

	//api auth routes
	Route::group(['middleware'=>'auth:api','guard'=>'api'],function()
	{
		Route::resource('lists','ListsController',[
			'except'=>['create','edit']
			]);
		Route::resource('lists.items','ListsItemsController',[	
			'except'=>['create','edit']
			]);
		Route::resource('lists.items.images','ListsItemsImagesController',['except'=>['create','edit']
			]);
	});
		



});
