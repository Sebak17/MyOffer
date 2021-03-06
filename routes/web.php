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

Route::get('/rejestracja', 'AuthorizationController@pageSignUp')->name('pageAuthRegister');
Route::any('/wyloguj', 'AuthorizationController@logout')->name('logout');


Route::prefix('panel')->middleware('auth:web')->group(function () {

    Route::get('/dodaj_ogloszenie', 'PanelController@offer_add')->name('pagePanelOfferAdd');
    Route::get('/moje_ogloszenia', 'PanelController@offers_list')->name('pagePanelOffersList');

    Route::get('/obserwowane', 'PanelController@favorites_list')->name('pagePanelFavoritesList');

    Route::get('/ustawienia', 'PanelController@settings')->name('pagePanelSettings');
});



Route::prefix('admin')->group(function () {

	Route::get('/nieautoryzowany', 'AdminAuthController@not_authorized')->name('pageAdminNotAuth');
	Route::get('/logowanie', 'AdminAuthController@auth_signin')->name('pageAdminSignIn');
	Route::any('/wyloguj', 'AdminSystem\AuthController@logout')->name('logoutAdmin');

	Route::get('/panel', 'AdminPanelController@panel')->name('pageAdminDashboard');
});

Route::prefix('system')->group(function () {

	Route::prefix('auth')->group(function () {
		Route::post('signIn', 'AuthorizationController@signIn');
    	Route::post('signUp', 'AuthorizationController@signUp');
	});

	Route::prefix('user')->middleware('auth:web')->group(function () {
		Route::post('changeAvatar', 'PanelSystem\UserController@changeAvatar');
		Route::post('changePersonal', 'PanelSystem\UserController@changePersonal');
		Route::post('changePassword', 'PanelSystem\UserController@changePassword');
		
		Route::post('changeFavoriteStatus', 'PanelSystem\UserController@changeFavoriteStatus');
	});

	Route::prefix('panel')->middleware('auth:web')->group(function () {
		Route::post('categoriesList', 'PanelSystem\GeneralController@categoriesList');

		Route::post('offerImageUpload', 'PanelSystem\OffersController@offerImageUpload');
		Route::post('offerImageRemove', 'PanelSystem\OffersController@offerImageRemove');
		Route::post('offerAdd', 'PanelSystem\OffersController@addOffer');
	});

	Route::prefix('admin')->group(function () {
		Route::post('signIn', 'AdminSystem\AuthController@signIn');
	});

	Route::prefix('admin')->middleware('auth:admin')->group(function () {
	});
});