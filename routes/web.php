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

Route::get('/oferta/{id}/{name}', 'HomeController@offer')->where('id', '[0-9]+')->name('pageOfferItem');
Route::get('/oferty', 'HomeController@offers')->name('pageOffersList');

Route::get('/rejestracja', 'HomeController@main')->name('pageAuthRegister');
Route::any('/wyloguj', 'AuthorizationController@logout')->name('logout');


Route::prefix('panel')->middleware('auth:web')->group(function () {

    Route::get('/dodaj_ogloszenie', 'PanelController@offer_add')->name('pagePanelOfferAdd');

    Route::get('/moje_ogloszenia', 'PanelController@offers_list')->name('pagePanelOffersList');

    Route::get('/ustawienia', 'PanelController@settings')->name('pagePanelSettings');
});

Route::prefix('system')->group(function () {

	Route::prefix('auth')->group(function () {
		Route::post('signIn', 'AuthorizationController@signIn');
    	Route::post('signUp', 'AuthorizationController@signUp');
	});;

	Route::prefix('user')->middleware('auth:web')->group(function () {
		Route::post('changePersonal', 'PanelSystem\UserController@changePersonal');
		Route::post('changePassword', 'PanelSystem\UserController@changePassword');
	});;

	Route::prefix('panel')->middleware('auth:web')->group(function () {
		Route::post('offerImageUpload', 'PanelSystem\OffersController@offerImageUpload');
		Route::post('offerImageRemove', 'PanelSystem\OffersController@offerImageRemove');
		Route::post('offerAdd', 'PanelSystem\OffersController@addOffer');
	});;
});