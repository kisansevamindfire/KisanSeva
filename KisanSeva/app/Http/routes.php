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
    return view('Login.login');
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

Route::get('viewbids', function() {
    return view('farmer.viewbids');
});
Route::get('test1', function() {
    return view('test1');
});

//Route to go to the Addpost View.
Route::get('farmer', 'FarmerController@Index');

//Route to go to the Addpost View.
Route::get('addpost', 'FarmerController@FindAllCategory');

//Route to go to the ViewPost View.
Route::get('viewpost', 'FarmerController@FindAllPosts');

//Route for adding a post to database.
Route::post('AddPostData', 'FarmerController@CreatePost');

//Route for go get crops under specific category.
Route::get('viewCrops', 'FarmerController@FindCrops');

//Route to go to the farming tips view and show farming tips.
Route::get('farmingtips', 'FarmerController@FindAllTips');

//Route to show Farming Tips in Details.
Route::get('tipsdetails/{id}','FarmerController@TipDetails');

// Login Page
//Route::get('/', 'PagesController@getlogin');

// Register Page
Route::get('register', 'PagesController@getRegister');

// Test page which will read data of users and tips from Filemaker
Route::get('test', 'UsersController@index');

// Display farmingtips
Route::get('farmingtips', 'FarmerController@FindAllTips');

// Home page for Dealer
Route::get('dealer', 'DealerController@index');

// Dealer will see all the crop advertisements on this page
Route::get('viewadds', 'DealerController@viewadds');

// Dealer will see the details related to particular add
Route::get('details', 'DealerController@details');
