<?php
/**
* File: FarmerController.php
* Purpose: Calls the FMUser class to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: SatyaPriya Baral
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FMUser;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;
class FarmerController extends Controller
{
    /*
     * Show all the list of users in the database
     * @param void
     * @return list of data
     */
    public function FindAllTips()
    {
        $records = FMUser::FindAll( 'Tips' );
        return view('farmer.farmingtips', compact('records'));
    }
    public function TipDetails($id)
    {
        $records = FMUser::Find( 'Tips' , $id);
        return view('farmer.tipsdetails', compact('records'));
    }
    public function FindAllCategory()
    {
        $records = FMUser::FindAll( 'Category' );
        return view('farmer.addpost', compact('records'));
    }
    public function FindCrops(Request $request)
    {
         $data = FMUser::FindCrop( 'Crop', $request->id );
        // dd($data);
         //print_r($data);
         //dd(gettype($data));
        // $data = json_encode($data);
         //return gettype($data);
         //return view(compact('data'));
        // if (isset($data)) {
        //    return response()->json(compact('data'), 200);
       // }
         return response()->json($data);
    }
}
