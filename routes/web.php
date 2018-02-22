<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
	
});

Route::prefix('shop')->group(function () {
	Route::get('/', 'ShopController@index');
	Route::get('/dodaj', 'ShopController@create');
	Route::get('/edytuj', 'ShopController@update');
	Route::get('/usun', 'ShopController@delete');
	
});

Route::get('/wollet', 'WolletController@index');

Route::get('/paragon', 'ParagonController@index');
Route::any('/zapisz', 'ParagonController@zapiszParagon');