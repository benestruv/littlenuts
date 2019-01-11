<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('movies/{id}', 'SPAController@showMovieDetails');
Route::get('actors/{id}', 'SPAController@showActorDetails');
Route::get('movies', 'SPAController@showMovies');
Route::get('actors', 'SPAController@showActors');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('settings/account', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/account', 'Settings\AccountController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::get('watchlist', 'SPAController@getWatchList');
    Route::get('watchedlist', 'SPAController@getWatchedList');
    Route::get('starredlist', 'SPAController@getStarredList');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('catalogue', function (Request $request) {
        return $request->movies();
    });
    Route::get('catalogue', function (Request $request) {
        return $request->movies();
    });
    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
