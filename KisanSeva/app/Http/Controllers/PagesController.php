<?php

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
