<?php
/**
* File: DealerController.php
* Purpose: Calls the DealerModal class to fetch the data from filemaker database
* Date: 24-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DealerModel;

use App\Http\Requests;

use App\Classes;

use Illuminate\Routing\Controller;

use App\Services\Dealer\DealerServices;

class DealerController extends Controller
{

    /**
    * Function to go to Farmer View.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Returns to the desired view of desired user.
    */
    public function dealer()
    {
        return view('Dealer.index');
    }

    public function details()
    {
        return view("Dealer.details");
    }

    public function viewprevious()
    {
        return view("Dealer.viewprevious");
    }

    public function viewads(Request $request)
    {
        $sessionArray = $request->session()->all();
        $records = DealerServices::findAllPosts($request->all(), $sessionArray['user']);
        if ($records !== false) {
            return view('Dealer.viewads', $records);
        }
        return view('Dealer.viewads')->withErrors(['message' => 'No Post Found']);
    }

    /**
    * Function to get all profile data of farmer.
    *
    * @param 1. $request - contains all session data.
    * @return - Returns to the Crop post page.
    */
    public function profileDealer(Request $request)
    {
        $sessionArray = $request->session()->all();
        $profileData = DealerServices::profileDealer($sessionArray['user']);
       // $post = DealerServices::postCountDealer($sessionArray['user']);

        if ($profileData != false) {
            return view('Dealer.profileDealer', compact('profileData', 'post'));
        }

        return false;
    }
}
