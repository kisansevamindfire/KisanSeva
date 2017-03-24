<?php
/**
* File: PagesController.php
* Purpose: Calls the FMUser class to fetch the data from filemaker database
* Date: 24-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;


class DealerController extends Controller
{
	
	public function index() {
		return view("Dealer.index");
    }
	
	public function viewadds() {
		return view("Dealer.viewadds");
    }

    public function details() {
		return view("Dealer.details");
    }
	
	public function viewprevious() {
		return view("Dealer.viewprevious");
    }

}