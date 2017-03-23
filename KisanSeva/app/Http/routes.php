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

Route::get('admin', function() {
	return view('admin.index');
});
Route::get('farmer', function() {
    return view('farmer.index');
});
Route::get('profile', function() {
    return view('farmer.profile');
});
Route::get('viewpost', function() {
    return view('farmer.ViewPost');
});
Route::get('addpost', function() {
    return view('farmer.addPost');
});
Route::get('farmingtips', function() {
    return view('farmer.farmingtips');
});
Route::get('viewbids', function() {
    return view('farmer.viewbids');
});
Route::get('test1', function() {
    return view('test1');
});
Route::get('test', 'UsersController@index');
Route::get('test', 'UsersController@ViewTips');

//Route::get('test', 'UsersController@index1');

// Route::get('test', function() {
//     return view('evaluators.index');
// });
Route::get('register', 'PagesController@getRegister');
Route::get('/', 'PagesController@getlogin');