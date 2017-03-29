<?php
/**
* File: DealerController.php
* Purpose: Calls the DealerModal class to fetch the data from filemaker database
* Date: 24-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DealerModal;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;


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