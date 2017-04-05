<?php
/**
* File: LoginController.php
* Purpose: Calls the UserModal class to fetch the user data
* Date: 3-Apr-2017
* Author: Satyapriya Baral
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FarmerModel;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes;
use App\Post;
use Session;
use App\Services\LoginServices;

class LoginController extends Controller
{

    /**
    * Function to sign in to the required user home page.
    *
    * @param 1. Reguest - Contains all data of user for login.
    * @return - Returns to the route of desired user.
    */
   public function login(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'Email' => 'required|email',
            'Password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return view('Login.login')->withErrors($validator)->withInput();
        }
        $records = LoginServices::login($request->all());
        if ($records !== false) {
            if ($records[0]->getField('__kfn_UserType') != 1) {
                $request->session()->put('user', $records[0]->getField('___kpn_UserId'));
                $request->session()->put('name', $records[0]->getField('UserName_xt'));
                $request->session()->put('type', $records[0]->getField('__kfn_UserType'));
                if ($records[0]->getField('__kfn_UserType') == 2) {
                    return redirect('dealer');
                } elseif ($records[0]->getField('__kfn_UserType') == 3) {
                    return redirect('farmer');
                }
            }
        }
        return view('Login.login')->withErrors(['message' => 'Invalid Username or Password'],'login');
    }

    /**
    * Function to register a user.
    *
    * @param 1. Reguest - Contains all data of user to register.
    * @return - Returns to the route of desired user.
    */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'UserType' => 'required',
            'Email' => 'required|email',
            'Name'=> 'required|min:5',
            'Password' => 'required|min:5',
            'RetypePassword' => 'required|same:Password',
            'Number' => 'required|min:10|max:10'
        ]);
        if ($validator->fails()) {
            return view('Login.register')->withErrors($validator);
        }
        else
        {
            $emailCheck = LoginServices::checkEmail($request->all());
            if ($emailCheck !== true) {
                $registerUsers = LoginServices::register($request->all());
                if ($registerUsers !== false) {
                    return view('Login.register')->withErrors(['message' => 'You are Succesfully Registered'],'login');;
                }
                return view('Login.register')->withErrors(['message' => 'Something Went Wrong'],'login');
            } else {
                return view('Login.register')->withErrors(['message' => 'Email Already Exists'],'login');
            }
        }
        return view('Login.login');
    }

    /**
    * Function to signout.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Returns to login view.
    */
    public function signout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
