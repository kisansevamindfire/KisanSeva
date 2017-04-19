<?php
/**
* File: DealerController.php
* Purpose: Calls the DealerModal class to fetch the data from filemaker database
* Date: 24-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DealerModel;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;
use App\Services\Dealer\DealerServices;
use Validator;
use Session;
use App\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Image;

class DealerController extends Controller
{

        /**
    * Function to go to Farmer View.
    *
    * @param array $request - Contains all session data.
    * @return - Returns to the desired view of desired user.
    */
    public function dealer(Request $request)
    {
        $sessionArray = $request->session()->all();
        $dashboardData = DealerServices::DashboardDataDealer($sessionArray['user']);
        return view('dealer.index', compact('dashboardData'));
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
        $profileDataDealer = DealerServices::profileDealer($sessionArray['user']);
       // $post = DealerServices::postCountDealer($sessionArray['user']);

        if ($profileDataDealer != false) {
            return view('Dealer.profileDealer', compact('profileDataDealer', 'post'));
        }

        return false;
    }

    /**
    * Function to Find all Crops Under Category.
    *
    * @param 1. $request - contains id of the Category and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public function details(Request $request)
    {
        $details = DealerServices::getadDetails($request->id, $request->session()->get('user'));
        return view('Dealer.details', compact('details'));
    }

    public function commentDealer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'commentData' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('details')->withErrors($validator);
        }
        $sessionArray = $request->session()->all();
        $addComment = DealerServices::CommentDealer($request->all(), $sessionArray['user'], $request->id);
        if ($addComment) {
            return back();
        }
        return back();
    }

    /**
    * Function to sign in to the required user home page.
    *
    * @param array Reguest - Contains all data of user for login.
    * @return - Returns to the route of desired user.
    */
    public function editProfileDealer(Request $request)
    {
        //validation of field for edit.
        $validator = Validator::make($request->all(),[
            'Name' => 'required|min:5',
            'Contact' => 'required|min:10|max:10'
        ]);

        if ($validator->fails()) {
            return redirect('profileDealer')->withErrors($validator);
        }

        $sessionArray = $request->session()->all();
        if($request->hasfile('imageData')) {
            $image = $request->file('imageData');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(200,200)->save($location);
            $request->session()->put('userImage', $filename);
            DealerServices::editProfileDealer($request->all(), $sessionArray['recordId'], $filename);
        } else {
            DealerServices::editProfileDealer($request->all(), $sessionArray['recordId'], 0);
        }
        //if validation succesful edit the profile
        $request->session()->put('name', $request->Name);
        return redirect('profileDealer');
    }

    /**
    * Function to add new Bid.
    *
    * Author : Satyapriya Baral
    * @param 1. mixed $request - contains all data of bid.
    * @return - Returns to the ad details view.
    */
    public function addBid(Request $request)
    {
        //validation of field for bid.
        $validator = Validator::make($request->all(),[
            'bid' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        DealerServices::addBid($request->bid, $request->id, $request->session()->get('user'));
        return back();
    }
}
