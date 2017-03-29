<?php
/**
* File: LoginController.php
* Purpose: Calls the LoginUser class to fetch the data from filemaker database
* Date: 20-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UserModal;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;


class LoginController extends Controller
{
    public function getlogin() {
		return view("Login.login");
    }

    public function getRegister() {

    $input = $_POST;
    $returnValue = UserModal::addUser('User',$input);
    if ($returnValue) {
        return redirect('/');
    }
    return back();
    }
}
