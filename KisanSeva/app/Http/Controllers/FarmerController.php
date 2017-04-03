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

class FarmerController extends Controller
{

    /**
    * Function to go to Farmer View.
    *
    * @param 1. Reguest - Contains all session data.
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
        $records = FarmerModel::findAll('Tips');
        return view('farmer.farmingtips', compact('records', 'sessionArray'));
    }

    /**
    * Function to get Specific Farming Tips Data.
    *
    * @param 1. $id - contains record id of specific farming tip to be displayed.
    *        2. Reguest - Contains all session data.
    * @return - Filemaker results of Farming Tips found.
    */
    public function tipDetails(Request $request, $id)
    {
        $records = FarmerModel::find('Tips', $id, '___kpn_TipId');
        return view('farmer.tipsdetails', compact('records', 'sessionArray'));
    }

    /**
    * Function to get all the Category.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Filemaker results of Category Found.
    */
    public function findAllCategory(Request $request)
    {
        $records = FarmerModel::findAll('Category');
        return view('farmer.addpost', compact('records', 'sessionArray'));
    }

    /**
    * Function to Find all Crops Under Category.
    *
    * @param 1. $request - contains id of the Category and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public function findCrops(Request $request)
    {
        $records = FarmerModel::find('Crop', $request->id, '__kfn_CategoryId');
        $i = 0 ;
        $array = [];
        foreach ($records as $record) {
            $array[$i] = [$record->getField('CropName_xt'), $record->getField('___kpn_CropId')];
            $i = $i+1;
        }
        return response()->json($array);
    }

    /**
    * Function to Find post according to search field.
    *
    * @param 1. $request - contains id of the Category and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public function findSpecificPosts(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("m/d/Y");
        $sessionArray = $request->session()->all();
        $records = FarmerModel::findPosts('CropPost', $request->cropName, $sessionArray['user']);
        if ($records == false) {
            return response()->json(false);
        }
        $i=0;
        foreach ($records as $record) {
            $cropRecord = FarmerModel::find('Crop', $record->getField('__kfn_CropId'), '___kpn_CropId');
            $today_time = strtotime($date);
            $expire_time = strtotime($record->getField('CropExpiryTime_xi'));
            if($record->getField('Sold_n') == 1) {
                $status = 1; }
            elseif ($expire_time < $today_time) {
                $status = 2;
            } else { $status = 3; }

            $postDetails[$i] = [$record->getField('CropName_t'), $record->getField('CropPrice_xn'), $record->getField('CropExpiryTime_xi'), $record->getField('Quantity_xn'), $record->getField('PublishedTime_t'), $status];
            $categoryRecord = FarmerModel::find('Category', $cropRecord[0]->getField('__kfn_CategoryId'), '___kpn_CategoryId');
            $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
            $i = $i + 1;
        }
        $PostRecords = array(
            $postDetails,
            $categoryDetails
        );
        return response()->json($PostRecords);
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
        $cropName = FarmerModel::find('Crop', $request->Crop , '___kpn_CropId');
        $return = FarmerModel::addPost('CropPost', $request->all(), $sessionArray['user'], $cropName[0]->getField('CropName_xt'));
        if ($return == true) {
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
        $records = FarmerModel::find('CropPost', $sessionArray['user'], '__kfn_UserId');
        $i=0;
        foreach ($records as $record) {
            $cropRecord = FarmerModel::find('Crop', $record->getField('__kfn_CropId'), '___kpn_CropId');
            $categoryRecord = FarmerModel::find('Category', $cropRecord[0]->getField('__kfn_CategoryId'), '___kpn_CategoryId');
            $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
            $i = $i + 1;
        }
        $PostRecords = array(
            $records,
            $categoryDetails
        );
        return view('farmer.ViewPost', compact('PostRecords', 'sessionArray'));
    }

    /**
    * Function to signout.
    *
    * @param 1. Reguest - Contains all session data.
    * @return - Returns to login view.
    */
    public function signout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
