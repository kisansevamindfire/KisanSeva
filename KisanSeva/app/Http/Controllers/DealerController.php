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
	
	/*public function viewadds() {
		return view("Dealer.viewadds");
    }
*/
    public function details() {
		return view("Dealer.details");
    }
	
	public function viewprevious() {
		return view("Dealer.viewprevious");
    }
    
    public function viewadds()
    {
        $records = DealerModal::FindAll( 'CropPost' );
        $i=0;
        foreach ($records as $record) {
            $cropRecord = DealerModal::Find('Crop', $record->getField('__kfn_CropId') , '___kpn_CropId');
            $cropDetails[$i] = [ $cropRecord[0]->getField('CropName_xt'), $cropRecord[0]->getField('___kpn_CropId')];
            $categoryRecord = DealerModal::Find('Category',$cropRecord[0]->getField('__kfn_CategoryId') , '___kpn_CategoryId' );
            $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
            $i = $i + 1;
        }
        $PostRecords = array(
            $records,
            $cropDetails,
            $categoryDetails
        );
        return view('Dealer.viewadds', compact('PostRecords'));

       //dd($PostRecords[1][2][0]);
        //dd($PostRecords[0][0]->getField('__kfn_CropId'));
        //dd($categoryDetails);
        //return view('farmer.ViewPost', compact('records'));
    }

}
