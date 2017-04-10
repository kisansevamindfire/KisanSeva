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

      /*  $PostRecords = DealerServices::findAllPosts();
        return view('Dealer.viewads', compact('PostRecords'));*/

/*        $sessionArray = $request->session()->all();
        $records = dealerServices::findAllPosts($request->all(), $sessionArray['user']);
        if ($records !== false) {
            return view('Dealer.viewads', $records);
        }
        return view('Dealer.viewads')->withErrors(['message' => 'No Post Found']);
*/
        /*$crops = DealerModel::FindAll('CropPost');
        $i=0;
        foreach ($crops as $crop) {
            $cropRecord = DealerModel::Find('Crop', $crop->getField('__kfn_CropId'), '___kpn_CropId');
            $cropDetails[$i] = [ $cropRecord[0]->getField('CropName_xt'), $cropRecord[0]->getField('___kpn_CropId')];
            $categoryRecord = DealerModel::Find('Category', $cropRecord[0]->getField('__kfn_CategoryId'), '___kpn_CategoryId');
            $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
            $i = $i + 1;
        }
        $PostRecords = array(
            $crops,
            $cropDetails,
            $categoryDetails
        );
        return view('Dealer.viewads', compact('PostRecords'));*/
    }

