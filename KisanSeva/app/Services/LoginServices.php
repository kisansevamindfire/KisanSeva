<?php
/**
* File: LoginServices.php
* Purpose: Calls the UserModal class to fetch the data from filemaker database
* Date: 03-Apr-2017
* Author: Satyapriya Baral
*/
namespace App\Services;

use App\Model\UserModel;
use App\Model\FarmerModel;
use App\Http\Requests;
use App\Classes;
use App\Post;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
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
    * Function to check if email is present or not.
    *
    * @param array Reguest - Contains all data of user for login.
    * @return - Returns to the route of desired user.
    */
    public static function checkEmail($request)
    {
        $records = UserModel::find('User', $request['Email'], 'UserEmail_xt');
        return $records;
    }

    /**
    * Function to check if email is present or not.
    *
    * @param array Reguest - Contains all data of user for login.
    * @return - Returns to the route of desired user.
    */
    public static function findImage($id)
    {
        $records = UserModel::find('MediaUser', $id, '___kpn_MediaUserId');
        return $records;
    }

    /**
    * Function to verify the email and generate a random token value.
    *
    * @param array Reguest - Contains email data.
    * @return - Returns the token value and the record id of user.
    */
    public static function verifyEmail($request)
    {
        $records = UserModel::find('User', $request['Email'], 'UserEmail_xt');
        //creates a random number and send it with email
        if ($records) {
            if ($records[0]->getField('__kfn_UserType') != 1) {
                $str = "12375839qwertyuiolkghsacvbnmx";
                $str = str_shuffle($str);
                $str = substr($str, 0, 10);
                $rId = $records[0]->getRecordId();
                return compact('rId', 'str');
            }
        }
        return false;
    }

    /**
    * Function to add token to database.
    *
    * @param int id - contains the record id of user.
    * @param string token - contains the random token value
    * @return - Returns boolian value if the edit is succesful or not.
    */
    public static function addToken($id, $token)
    {
        $editUser = UserModel::edit('User', $token, $id);
        return $editUser;
    }

    /**
    * Function to check user email.
    *
    * @param string email - Contains user email address.
    * @param string token - contains random charecters.
    * @return - Returns all data of the user.
    */
    public static function checkEmailUser($email, $token)
    {
        $User = UserModel::findUser('User', $token, $email);
        return $User;
    }

    /**
    * Function to setup the new password.
    *
    * @param string Password - Contains the new password.
    * @param int rId - contains the record id of user.
    * @return - Returns boolian value if edit succesful or not.
    */
    public static function editPassword($password, $rId)
    {
        $editUser = UserModel::editPassword('User', $password, $rId);
        return $editUser;
    }
}
