<?php
/**
* File: LoginController.php

* Date: 20-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FarmerModel;
use App\Http\Requests;
use App\Classes;
use App\Post;
use Illuminate\Routing\Controller;
use Session;

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
        $records = FarmerModel::userDetails('User', $request->all());
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
        return redirect('/');
    }
}
                