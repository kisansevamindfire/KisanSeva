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

        //Route for getting details for the profile page
        Route::get('profile', 'FarmerController@profile');

        //Route to go to dealer profile page.
        Route::get('profileDealer','DealerController@profileDealer');

        //Route for go get crops under specific category.
        Route::get('viewCrops', 'FarmerController@findCrops');

        // Display farmingtips
        Route::get('farmingtips', 'FarmerController@FindAllTips');

        //Route to show Farming Tips in Details.
        Route::get('tipsdetails/{id}','FarmerController@tipDetails');

        //Reute to get all the post details of a specific post and its comments.
        Route::post('postDetails/{id}/commentData','FarmerController@comment');

        //Route to get the specific email detail.
        Route::post('email', 'LoginController@sendEmail');

        //Route to get post detail of a specific post.
        Route::get('postDetails/{id}', 'FarmerController@postDetails');

        //Route to get to the function to accept bids.
        Route::get('acceptBid/{id}', 'FarmerController@acceptBid');

        //Profile page for dealer
        Route::get('profileDealer','DealerController@profileDealer');

        // Home page for Dealer
        Route::get('dealer', 'DealerController@dealer');

        // Dealer will see all the crop advertisements on this page
        Route::get('viewads', 'DealerController@viewads');

        //Details page for dealer
        Route::get('details/{id}', 'DealerController@details');

        //Details page for dealer
        Route::get('deletePost/{id}', 'FarmerController@delete');

        //Details page for dealer
        Route::get('addRating/{farmerId}/{postId}', 'DealerController@addRating');

        //Comments section for Dealer
        Route::post('details/{id}/commentData','DealerController@commentDealer');

    });

    Route::group(['middleware' => ['auth']], function() {

        //Route to go to login page.
        Route::get('login', function () {
            return view('Login.login');
        });

        //Route to go to login page.
        Route::get('/', function () {
            return view('Login.login');
        });

        //Route to go to the Login View.
        Route::post('login', 'LoginController@login');

        //Route to get all forgot password details.
        Route::get('forgot', 'LoginController@forgot');

        //Route to get all details on forgot password.
        Route::post('forgotPassword', 'LoginController@getDetails');

        //Route to go to function for checking email and password for reset.
        Route::get('reset/{rId}/{token}/{email}', 'LoginController@resetpassword');

        //Route to reset the password by a new password.
        Route::post('reset/{rId}/{token}/resetPassword', 'LoginController@resetNewPassword');
    });

    //Route to go to signout and go to login View.
    Route::get('signout', 'LoginController@signout');

    //Route for adding a post to database.
    Route::post('AddPostData', 'FarmerController@createPost');

    //Route for getting search results of post.
    Route::get('viewRelatedPost', 'FarmerController@findSpecificPosts');

    //Route to go to the register page.
    Route::get('register', function () {
        return view('Login.register');
    });

    //Route to get all user details and register.
    Route::post('register','LoginController@register');

    //Route to get all user details and register.
    Route::post('details/{id}/addBid','DealerController@addBid');

    //Route to edit profile of user.
    Route::post('editProfile','FarmerController@editProfile');

    Route::post('editProfileDealer','DealerController@editProfileDealer');

    //Dealer will see his previous purchases
    Route::get('viewprevious', 'DealerController@viewprevious');
});



