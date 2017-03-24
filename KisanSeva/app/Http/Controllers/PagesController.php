<?php
/**
* File: PagesController.php
* Purpose: Calls the FMUser class to fetch the data from filemaker database
* Date: 20-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;


class PagesController extends Controller
{
    public function getlogin() {
		return view("pages.login");
    }

    
    public function getRegister() {
    	return view("pages.register");
    }

}
