<?php
/**
* File: DealerController.php
* Purpose: Calls the DealerModal class to fetch the data from filemaker database
* Date: 24-Mar-2017
* Author: Saurabh Mehta, Satyapriya Baral
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

/**
* Class containing all functions for interaction with the dealer views.
*/
class DealerController extends Controller
{

    /**
    * Function to go to Dealer Home Page.
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

    /**
    * Function to view all the crop post.
    *
    * Author : Satyapriya Baral
    * @param array $request - contains all the session data.
    * @return - Returns to the crop post view.
    */
    public function viewads(Request $request)
    {
        $sessionArray = $request->session()->all();
        //gets all post details.
        $records = DealerServices::findAllPosts($request->all(), $sessionArray['user']);
        //if records found return records else display an error.
        if ($records !== false) {
            return view('Dealer.viewads', $records);
        }
        return view('Dealer.viewads')->withErrors(['message' => 'No Post Found']);
    }

    /**
    * Function to get all profile data of dealer.
    *
    * @param 1. $request - contains all session data.
    * @return - Returns to the Crop post page.
    */
    public function profileDealer(Request $request)
    {
        $sessionArray = $request->session()->all();
        //get all profile details.
        $profileDataDealer = DealerServices::profileDealer($sessionArray['user']);

        if ($profileDataDealer != false) {
            return view('Dealer.profileDealer', compact('profileDataDealer', 'post'));
        }

        return false;
    }

    /**
    * Function to Find details of a specific post.
    *
    * Author - Satyapriya Baral
    * @param array $request - contains id of the Crop post and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public function details(Request $request)
    {
        //get specigic post details by its id.
        $details = DealerServices::getadDetails($request->id, $request->session()->get('user'));
        return view('Dealer.details', compact('details'));
    }

    /**
    * Function to add comment by the dealer.
    *
    * Author : Satyapriya Baral
    * @param mixed $request - contains all comment data and session data.
    * @return - Returns to the ad details view.
    */
    public function commentDealer(Request $request)
    {
        //validate the comment field
        $validator = Validator::make($request->all(), [
            'commentData' => 'required',
        ]);
        //if validator fails return error.
        if ($validator->fails()) {
            return redirect('details')->withErrors($validator);
        }

        //if validation succesful create a new comment record.
        $sessionArray = $request->session()->all();
        $addComment = DealerServices::commentDealer($request->all(), $sessionArray['user'], $request->id);
        if ($addComment) {
            return back();
        }
        return back();
    }

    /**
    * Function to edit the profile of dealer.
    *
    * @param array Reguest - Contains all data of dealer profile.
    * @return - Returns to the profile page after editing.
    */
    public function editProfileDealer(Request $request)
    {
        //validation of profile details for edit.
        $validator = Validator::make($request->all(), [
            'Name' => 'required|min:5',
            'Contact' => 'required|min:10|max:10'
        ]);
        //if validation fails return with error.
        if ($validator->fails()) {
            return redirect('profileDealer')->withErrors($validator);
        }
        //upload the image of dealer.
        $sessionArray = $request->session()->all();
        if ($request->hasfile('imageData')) {
            $image = $request->file('imageData');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(200, 200)->save($location);
            $request->session()->put('userImage', $filename);
            //upload all profile details of dealer.
            DealerServices::editProfileDealer($request->all(), $sessionArray['recordId'], $filename);
        } else {
            DealerServices::editProfileDealer($request->all(), $sessionArray['recordId'], 0);
        }
        //change the name of the user edited.
        $request->session()->put('name', $request->Name);
        return redirect('profileDealer');
    }

    /**
    * Function to add new Bid.
    *
    * Author : Satyapriya Baral
    * @param array $request - contains all data of bid.
    * @return - Returns to the ad details view.
    */
    public function addBid(Request $request)
    {
        //validation of field for bid.
        $validator = Validator::make($request->all(), [
            'bid' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        //create a new bid.
        DealerServices::addBid($request->bid, $request->id, $request->session()->get('user'));
        return back();
    }

    /**
    * Function to add rating.
    *
    * Author : Satyapriya Baral
    * @param array $request - contains all data of rating.
    * @return - Returns to the ad details view.
    */
    public function addRating(Request $request)
    {
        //create a new rating.
        DealerServices::addRating($request->farmerId, $request->postId, $request->rating, $request->session()->get('user'));
    }
}
