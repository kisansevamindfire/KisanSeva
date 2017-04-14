<?php
/**
* File: DealerServices.php
* Purpose: Calls the dealerModel to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: Saurabh Mehta
*/
namespace App\Services\Dealer;

use Illuminate\Http\Request;

use App\Model\DealerModel;

use App\Http\Requests;

use App\Classes;

class DealerServices
{
    public static function findAllPosts($request, $user)
    {
        $crops = DealerModel::findAll('CropPost', $user, '__kfn_UserId');
        if ($crops !== false) {
            $i=0;
            foreach ($crops as $crop) {
                $cropRecord = DealerModel::Find(
                    'Crop',
                    $crop->getField('__kfn_CropId'),
                    '___kpn_CropId'
                );
                $cropDetails[$i] = [ $cropRecord[0]->getField('CropName_xt'),
                $cropRecord[0]->getField('___kpn_CropId')];
                $categoryRecord = DealerModel::Find(
                    'Category',
                    $cropRecord[0]->getField('__kfn_CategoryId'),
                    '___kpn_CategoryId'
                );
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
    }

    /**
    * Function to get all profile data of user.
    *
    * @param 1. $userId - contains id of the user.
    * @return - Returns all profile details of user.
    */
    public static function profileDealer($userId)
    {
        $profileData = DealerModel::find('User', $userId, '___kpn_UserId');
        if ($profileData != false) {
            return $profileData;
        }
        return false;
    }

        /**
    * Function to find a specific crop post.
    *
    * @param 1. $request - contains the record id of post.
    * @return - Returns all data of the post.
    */
    public static function getadDetails($id)
    {
        $cropDetails= DealerModel::find('CropPostDetailsPortal', $id , 'RecordId_n');
        $cropRecord = $cropDetails[0]->getRelatedSet('Crop 2');
        $categoryName = DealerModel::find('Category', $cropRecord[0]->getField('Crop 2::__kfn_CategoryId'),
         '___kpn_CategoryId');
        $commentRecords = DealerModel::findComment('Comment', $cropDetails[0]->getField('___kpn_CropPostId'),
         '__kfn_CropPostId');

        if(!empty($commentRecords)) {
            $j = 0;
            foreach ($commentRecords as $commentRecord) {
                $commentUser[$j] = DealerModel::find('User', $commentRecord->getField('__kfn_UserId'),
                 '___kpn_UserId');
                $j++;
            }
        } else { $commentRecords = 0; $commentUser = 0; }

        if ($cropDetails[0]->getField('Sold_n') == 1) {
            $bidDetails = DealerModel::find('Bids', $cropDetails[0]->getField('__kfn_AcceptedBid'), '___kpn_BidId');
            $dealerDetails[0] = DealerModel::find('User', $bidDetails[0]->getField('__kfn_UserId'), '___kpn_UserId');
            return compact('cropDetails', 'categoryName', 'bidDetails', 'dealerDetails', 'id',
             'commentRecords', 'commentUser');
        }

        $bidDetails = dealerModel::find('Bids', $cropDetails[0]->getField('___kpn_CropPostId'),
         '__kfn_CropPostId');
        $i = 0;

        if ($bidDetails != false) {
            foreach ($bidDetails as $bidDetail) {
                $dealerDetails[$i] = DealerModel::find('User', $bidDetail->getField('__kfn_UserId'),
                 '___kpn_UserId');
                $i++;
            }
            return compact('cropDetails', 'categoryName', 'bidDetails', 'dealerDetails', 'id',
             'commentRecords', 'commentUser');
        }

        $bidDetails = false;
        return compact('cropDetails', 'categoryName', 'bidDetails', 'id', 'commentRecords',
         'commentUser');
    }

    public static function CommentDealer($request, $userId, $id)
    {
        $bid = DealerModel::CommentDealer('Comment', $request, $userId ,$id);
        return true;
    }
}

