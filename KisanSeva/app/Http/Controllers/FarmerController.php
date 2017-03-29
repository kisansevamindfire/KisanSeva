<?php
/**
* File: FarmerController.php
* Purpose: Calls the FarmerModal to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: SatyaPriya Baral
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FarmerModal;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;
class FarmerController extends Controller
{

    /*
    * Function to get All Farming Tips Data.
    *
    * @param Null.
    * @return - Filemaker results of all Farming Tips found.
    */
    public function FindAllTips()
    {
        $records = FarmerModal::FindAll( 'Tips' );
        return view('farmer.farmingtips', compact('records'));
    }

    /*
    * Function to get Specific Farming Tips Data.
    *
    * @param 1. $id - contains record id of specific farming tip to be displayed.
    * @return - Filemaker results of Farming Tips found.
    */
    public function TipDetails($id)
    {
        $records = FarmerModal::Find( 'Tips' , $id);
        return view('farmer.tipsdetails', compact('records'));
    }

    /*
    * Function to get all the Category.
    *
    * @param Null.
    * @return - Filemaker results of Category Found.
    */
    public function FindAllCategory()
    {
        $records = FarmerModal::FindAll( 'Category' );
        return view('farmer.addpost', compact('records'));
    }

    /*
    * Function to Find all Crops Under Category.
    *
    * @param 1. $request - contains id of the Category.
    * @return - Filemaker results of Crops Found under Category.
    */
    public function FindCrops(Request $request)
    {
        $data = FarmerModal::FindCrop( 'Crop', $request->id );
        return response()->json($data);
    }

    /*
    * Function to Create a Post of the crop.
    *
    * @param 1. $request - contains all data of the post to be created.
    * @return - RReturns to the Crop post page.
    */
    public function CreatePost(Request $request)
    {
        $return = FarmerModal::AddPost('CropPost' , $request->all());
        if ($return == true) {
            return back();
        }
        return back();
    }

    /*
    * Function to get all the Category.
    *
    * @param Null.
    * @return - Filemaker results of Category Found.
    */
    public function FindAllPosts()
    {
        $records = FarmerModal::FindAll( 'CropPost' );
        $i=0;
        foreach ($records as $record) {
            $cropRecord = FarmerModal::FindCropDetails('Crop',$record->getField('__kfn_CropId'));
            $cropDetails[$i] = [ $cropRecord[0]->getField('CropName_xt'), $cropRecord[0]->getField('___kpn_CropId')];
            $categoryRecord = FarmerModal::FindCategoryDetails('Category',$cropRecord[0]->getField('__kfn_CategoryId'));
            $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
            $i = $i + 1;
        }
       //dd($records);
        //dd($cropDetails);
        dd($categoryDetails);
        //return view('farmer.ViewPost', compact('records'));
    }

}
