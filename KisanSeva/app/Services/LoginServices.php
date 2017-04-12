<?php
/**
* File: LoginServices.php
* Purpose: Calls the UserModal class to fetch the data from filemaker database
* Date: 03-Apr-2017
* Author: Satyapriya Baral
*/
namespace App\Services;

use App\UserModel;
use App\FarmerModel;
use App\Http\Requests;
use App\Classes;
use App\Post;
use Illuminate\Routing\Controller;
use Session;

/**
* Class containing all functions for the login services.
*/
class LoginServices
{

    /**
    * Function to get all user data.
    *
    * @param array Reguest - Contains all data of user for login.
    *
    * @return - Returns to the route of desired user.
    */
    public static function login($request)
    {
        $records = UserModel::userDetails('User', $request);
        if ($records !== false) {
            return $records;
        }
        return false;
    }

     /**
    * Function to register a user.
    *
    * @param array Reguest - Contains all data of user for login.
    *
    * @return - Returns to the route of desired user.
    */
    public static function register($request)
    {
        $records = UserModel::addUsers('User', $request);
        if ($records !== false) {
            return true;
        }
        return false;
    }

    /**
    * Function to scheck if email is present or not.
    *
    * @param array Reguest - Contains all data of user for login.
    *
    * @return - Returns to the route of desired user.
    */
    public static function checkEmail($request)
    {
        $records = UserModel::find('User', $request['Email'], 'UserEmail_xt');
        return $records;
    }

}
