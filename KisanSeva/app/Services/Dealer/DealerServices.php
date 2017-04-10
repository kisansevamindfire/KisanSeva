<?php
/**
* File: DealerServices.php
* Purpose: Calls the dealerModel to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: Saurabh Mehta
*/
namespace App\Services\Dealer;

use Illuminate\Http\Request;

use App\DealerModel;

use App\Http\Requests;

use App\Classes;

class DealerServices
{
    public static function findAllPosts($request, $user)
    {
        $crops = DealerModel::findAll('CropPost', $user, '__kfn_UserId');
        if ($crops !== false) {
            $i=0;
            foreach ($crops as $crop){
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
                return compact('PostRecords');
            }
        return false;
//                return view('Dealer.viewads', compact('PostRecords'));
    }
}

