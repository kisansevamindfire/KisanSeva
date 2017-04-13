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
    
        Route::get('profile', 'FarmerController@profile');
        
        //Route for go get crops under specific category.
        Route::get('viewCrops', 'FarmerController@findCrops');
    
        // Display farmingtips
        Route::get('farmingtips', 'FarmerController@FindAllTips');
    
        //Route to show Farming Tips in Details.
        Route::get('tipsdetails/{id}','FarmerController@tipDetails');

        Route::post('postDetails/{id}/commentData','FarmerController@comment');

        Route::get('postDetails/{id}', 'FarmerController@postDetails');

        Route::get('acceptBid/{id}', 'FarmerController@acceptBid');

        //Profile page for dealer
        Route::get('profileDealer','DealerController@profileDealer');
        
        // Home page for Dealer
        Route::get('dealer', 'DealerController@dealer');

        // Dealer will see all the crop advertisements on this page
        Route::get('viewads', 'DealerController@viewads');

        //Details page for dealer
        Route::get('details/{id}', 'DealerController@details');

        //Comments Page for Dealer
        Route::post('details/{id}/commentDataDealer','DealerController@commentDealer');

    });
   
    Route::group(['middleware' => ['auth']], function() {
    
        Route::get('login', function () {
            return view('Login.login');
        });
    
        Route::get('/', function () {
            return view('Login.login');
        });
        //Route to go to the Login View.
        Route::post('login', 'LoginController@login');
    });
    
    //Route to go to signout and go to login View.
    Route::get('signout', 'LoginController@signout');
    
    Route::get('viewbids', function() {
        return view('farmer.viewbids');
    });
    
    //Route for adding a post to database.
    Route::post('AddPostData', 'FarmerController@createPost');
    
    //Route for getting search results of post.
    Route::get('viewRelatedPost', 'FarmerController@findSpecificPosts');
    
    Route::get('viewbids', function() {
        return view('farmer.viewbids');
    });
    
    Route::get('register', function () {
        return view('Login.register');
    });

    Route::post('register','LoginController@register');
    
    Route::post('editProfile','FarmerController@editProfile');
    });
    
    // Test page which will read data of users and tips from Filemaker
    Route::get('test', 'UsersController@index');
    
    // Dealer will see the details related to particular add
    Route::get('details', 'DealerController@details');
    
    // dealer will see his previous purchases
    Route::get('viewprevious', 'DealerController@viewprevious');