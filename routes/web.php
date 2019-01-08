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

Route::get('/test', function () {
    return App\Movie::all();
});


Route::resource('movie', 'MovieController');
Route::resource('actor', 'ActorController');
Route::resource('list', 'ListController');
Route::resource('user', 'UserController');
Route::resource('search', 'SearchController');
// GUEST -------------------------------------------------------------------- //

// Homepage
Route::get('/', 'PublicController@index')->name('index');

// Actors
Route::get('/actors', 'PublicController@actors')->name('actors.all');
Route::get('/actors/{id}', 'PublicController@actor')->name('actors.one');

// Movies
Route::get('/movies', 'PublicController@movies')->name('movies.all');
Route::get('/movies/{id}', 'PublicController@movie')->name('movies.one');

// AUTH --------------------------------------------------------------------- //

Route::get('/moviecard/{id}', 'MovieController@showMovie')->name('show_movie'); // Afficher un film en particulier
// Authentication
Auth::routes();

// Dashboard
Route::get('/home/{action?}', 'HomeController@index')->name('home');

// Others
Route::get('/user_settings', 'SettingsController@settings');
Route::patch('/settings', 'SettingsController@edit'); 

// Add to lists
Route::post(
    '/add-to-watch-list',
    'HomeController@addToWatchList'
)->name('add-to-watch-list');
Route::post(
    '/remove-from-watch-list',
    'HomeController@removeFromWatchList'
)->name('remove-from-watch-list');

Route::post(
    '/add-to-watched-list',
    'HomeController@addToWatchedList'
)->name('add-to-watched-list');
Route::post(
    '/remove-from-watched-list',
    'HomeController@removeFromWatchedList'
)->name('remove-from-watched-list');

Route::post(
    '/add-to-starred-list',
    'HomeController@addToStarredList'
)->name('add-to-starred-list');
Route::post(
    '/remove-from-starred-list',
    'HomeController@removeFromStarredList'
)->name('remove-from-starred-list');

// Search

Route::get('/search', 'SearchController@searchMovie');