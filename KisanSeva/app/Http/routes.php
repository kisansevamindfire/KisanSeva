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
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['CheckUser']], function() {

        //Route to go to the Farmer Home Page View.
        Route::get('farmer', 'FarmerController@farmer');

        //Route to go to the Addpost View.
        Route::get('addpost', 'FarmerController@findAllCategory');

        //Route to go to the ViewPost View.
        Route::get('viewpost', 'FarmerController@findAllPosts');

        Route::get('profile', function() {
            return view('farmer.profile');
        });

        //Route for go get crops under specific category.
        Route::get('viewCrops', 'FarmerController@findCrops');

        // Display farmingtips
        Route::get('farmingtips', 'FarmerController@FindAllTips');

    });

    Route::group(['middleware' => ['auth']], function() {

        Route::get('/', function () {
            return view('Login.login');
        });

    });

    //Route to go to the Login View.
    Route::post('index', 'LoginController@login');

    //Route to go to signout and go to login View.
    Route::get('signout', 'FarmerController@signout');

});



Route::get('profile', function() {
    return view('farmer.profile');
});

Route::get('viewbids', function() {
    return view('farmer.viewbids');
});




//Route for adding a post to database.
Route::post('AddPostData', 'FarmerController@createPost');

//Route for getting search results of post.
Route::get('viewRelatedPost', 'FarmerController@findSpecificPosts');

//Route to go to the farming tips view and show farming tips.
//Route::get('farmingtips', 'FarmerController@findAllTips');

//Route to show Farming Tips in Details.
Route::get('tipsdetails/{id}','FarmerController@TipDetails');
Route::get('tipsdetails/{id}','FarmerController@tipDetails');

// Login Page
//Route::get('/', 'PagesController@getlogin');

// Register Page
Route::get('register', 'LoginController@registerUser');
// Test page which will read data of users and tips from Filemaker
Route::get('test', 'UsersController@index');

// Home page for Dealer
Route::get('dealer', 'DealerController@index');

// Dealer will see all the crop advertisements on this page
Route::get('viewadds', 'DealerController@viewadds');

// Dealer will see the details related to particular add
Route::get('details', 'DealerController@details');

 // dealer will see his previous purchases
Route::get('viewprevious', 'DealerController@viewprevious');
