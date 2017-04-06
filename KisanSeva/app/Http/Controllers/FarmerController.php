<?php
/**
* File: FarmerController.php
* Purpose: Calls the FarmerModal to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: SatyaPriya Baral
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FarmerModel;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;
use App\Services\Farmer\FarmerServices;

class FarmerController extends Controller
{

    /**
    * Function to go to Farmer View.
    *
    * @param Null
    * @return - Returns to the desired view of desired user.
    */
    public function farmer()
    {
        return view('farmer.index');
    }
    /**
    * Function to get All Farming Tips Data.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Filemaker results of all Farming Tips found.
    */
    public function findAllTips(Request $request)
    {
        $records = FarmerServices::findAllTips('Tips');
        return view('farmer.farmingtips', compact('records'));
    }

    /**
    * Function to get Specific Farming Tips Data.
    *
    * @param 1. $id - contains record id of specific farming tip to be displayed.
    *        2. Reguest - Contains all session data.
    * @return - Filemaker results of Farming Tips found.
    */
    public function tipDetails($id)
    {
        $tips = FarmerServices::tipDetails($id);
        return view('farmer.tipsdetails', compact('tips'));
    }

    /**
    * Function to get all the Category.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Filemaker results of Category Found.
    */
    public function findAllCategory(Request $request)
    {
        $records = FarmerServices::findAllCategory();
        return view('farmer.addpost', compact('records'));
    }

    /**
    * Function to Find all Crops Under Category.
    *
    * @param 1. $request - contains id of the Category and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public function findCrops(Request $request)
    {
        $records = FarmerServices::findCrops($request->id);
        return response()->json($records);
    }

    /**
    * Function to Create a Post of the crop.
    *
    * @param 1. $request - contains all data of the post to be created and all session data.
    * @return - Returns to the Crop post page.
    */
    public function createPost(Request $request)
    {
        $sessionArray = $request->session()->all();
        $addPost = FarmerServices::createPost($request->all(), $sessionArray['user']);
        if ($addPost == true) {
            return redirect('viewpost');
        }
        return back();
    }

    /**
    * Function to get all posts.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Array of all post data.
    */
    public function findAllPosts(Request $request)
    {
        $sessionArray = $request->session()->all();
        $records = FarmerServices::findAllPosts($request->all(), $sessionArray['user']);
        if ($records !== false) {
            return view('farmer.ViewPost', $records);
        }
        return view('farmer.ViewPost')->withErrors(['message' => 'No Post Found']);
    }
}
