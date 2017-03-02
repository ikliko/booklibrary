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
//client
Route::get('/', 'BookController@create');
Route::resource('books', 'BookController');
Route::get('login', 'UserController@login');
Route::post('login', 'UserController@doLogin');
Route::get('logout', 'UserController@logout');
Route::put('profile/edit/password', 'UserController@changePassword');
Route::get('profile/{id}/edit', function () {
    return redirect()->to('settings');
});
Route::get('settings', 'UserController@edit');
Route::resource('/profile', 'UserController');
Route::get('lang/{lang}', function ($lang) {
    Session::put('lang', $lang);
    return redirect()->back();
});
Route::resource('bookmarks', 'FavouriteController');

//server
Route::get('/panel/book/accepted', 'BookEntityController@accepted');
Route::get('/panel/book/pending', 'BookEntityController@pending');
Route::get('/panel/book/declined', 'BookEntityController@declined');
Route::resource('panel/book', 'BookEntityController');
Route::get('panel/Book/all', function () {
    return redirect()->to('panel/book');
});
Route::resource('panel/users', 'UserEntityController');
Route::get('/panel/User/all', function () {
    return redirect()->to('panel/users');
});

//API
Route::get('api/search', 'Api\SearchController@index');