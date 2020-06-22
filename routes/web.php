<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@main')->name('home');



Route::get('/rejestracja', 'HomeController@main')->name('page_auth_register');
Route::any('/wyloguj', 'AuthorizationController@logout')->name('logout');

Route::prefix('system')->group(function () {

	Route::prefix('auth')->group(function () {
		Route::post('signIn', 'AuthorizationController@signIn');
    	Route::post('signUp', 'AuthorizationController@signUp');
	});;
});