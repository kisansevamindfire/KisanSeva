<?php
/**
* File: FarmerServices.php
* Purpose: Calls the FarmerModal to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: Satyapriya Baral
*/
namespace App\Services\Farmer;

use Illuminate\Http\Request;
use App\FarmerModel;
use App\Http\Requests;
use App\Classes;

class FarmerServices
{

    /**
    * Function to get All Farming Tips Data.
    *
    * @param 1. tipId - Contains id of a specific tip.
    * @return - Filemaker results of all Farming Tips found.
    */
    public static function findAllTips($tipId)
    {
        $farmingTips = FarmerModel::findAll($tipId);
        return $farmingTips;
    }

    /**
    * Function to Find all Crops Under Category.
    *
    * @param 1. $id - contains id of the Category and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public static function findCrops($id)
    {
        $crops = FarmerModel::find('Crop', $id, '__kfn_CategoryId');
        $i = 0 ;
        $cropDetails = [];
        foreach ($crops as $crop) {
            $cropDetails[$i] = [$crop->getField('CropName_xt'), $crop->getField('___kpn_CropId')];
            $i = $i+1;
        }
        return $cropDetails;
    }

    /**
    * Function to get Specific Farming Tips Data.
    *
    * @param 1. $id - contains record id of specific farming tip to be displayed.
    * @return - Filemaker results of Farming Tips found.
    */
    public static function tipDetails($id)
    {
        $tipDetails = FarmerModel::find('Tips', $id, '___kpn_TipId');
        return $tipDetails;
    }

    /**
    * Function to get all the Category.
    *
    * @param Null.
    * @return - Filemaker results of Category Found.
    */
    public static function findAllCategory()
    {
        $categoryDetails = FarmerModel::findAll('Category');
        return $categoryDetails;
    }

    /**
    * Function to Create a Post of the crop.
    *
    * @param 1. $request - contains all data of the post to be created.
    *        2. $user - contains the id of the user who made the post.
    * @return - Returns a boolian value if post made or not.
    */
    public static function createPost($request, $userId)
    {
        $cropName = FarmerModel::find('Crop', $request['Crop'] , '___kpn_CropId');
        $return = FarmerModel::addPost('CropPost', $request, $userId, $cropName[0]->getField('CropName_xt'));
        if ($return != true) {
            return false;
        }
        return true;
    }

    /**
    * Function to get all posts of the user.
    *
    * @param 1. Reguest - Contains all session data to find the post.
    *        2. $user - Contains the id of user.
    * @return - Array of all post data.
    */
    public static function findAllPosts($request, $user)
    {
        $posts = FarmerModel::find('CropPost', $user, '__kfn_UserId');
        if ($posts !== false) {
            $i=0;
            foreach ($posts as $post) {
                $cropRecord = FarmerModel::find('Crop', $post->getField('__kfn_CropId'), '___kpn_CropId');
                $categoryRecord = FarmerModel::find('Category', $cropRecord[0]->getField('__kfn_CategoryId'),
                 '___kpn_CategoryId');
                $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
                $i = $i + 1;
            }
            $PostRecords = array(
                $posts,
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
    public static function profile($userId)
    {
        $profileData = FarmerModel::find('User', $userId, '___kpn_UserId');
        if ($profileData != false) {
            return $profileData;
        }
        return false;
    }

     /**
    * Function to get all profile data of user.
    *
    * @param 1. $userId - contains id of the user.
    * @return - Returns all profile details of user.
    */
    public static function postCount($userId)
    {
        $posts = FarmerModel::find('CropPost', $userId, '__kfn_UserId');
        $count = count($posts);
        $lastPostTime = $posts[$count-1]->getField('PublishedTime_t');
        $totalPosts = 0;
        $postSold = 0;
        if ($posts) {
            foreach ($posts as $post) {
                $totalPosts++;
                if ($post->getField('Sold_n') === 1)
                    { $postSold++; }
            }
        }
        $countPost = array(
            $totalPosts,
            $postSold,
            $lastPostTime
        );
        return compact('countPost');
    }

    /**
    * Function to Create a Post of the crop.
    *
    * @param 1. $request - contains all data of the post to be created.
    *        2. $user - contains the id of the user who made the post.
    * @return - Returns a boolian value if post made or not.
    */
    public static function editProfile($request, $userId)
    {
        $editProfile = FarmerModel::editRecords('User', $request , $userId);
        if ($editProfile != true) {
            return false;
        }
        return true;
    }

    /**
    * Function to find a specific crop post.
    *
    * @param 1. $request - contains the record id of post.
    * @return - Returns all data of the post.
    */
    public static function findCropDetails($id)
    {
        $cropDetails= FarmerModel::find('CropPostDetailsPortal', $id , 'RecordId_n');
        $cropRecord = $cropDetails[0]->getRelatedSet('Crop 2');
        $categoryName = FarmerModel::find('Category', $cropRecord[0]->getField('Crop 2::__kfn_CategoryId'),
         '___kpn_CategoryId');
        $commentRecords = FarmerModel::findComment('Comment', $cropDetails[0]->getField('___kpn_CropPostId'),
         '__kfn_CropPostId');

        if(!empty($commentRecords)) {
            $j = 0;
            foreach ($commentRecords as $commentRecord) {
                $commentUser[$j] = FarmerModel::find('User', $commentRecord->getField('__kfn_UserId'),
                 '___kpn_UserId');
                $j++;
            }
        } else { $commentRecords = 0; $commentUser = 0; }

        if ($cropDetails[0]->getField('Sold_n') == 1) {
            $bidDetails = FarmerModel::find('Bids', $cropDetails[0]->getField('__kfn_AcceptedBid'), '___kpn_BidId');
            $dealerDetails[0] = FarmerModel::find('User', $bidDetails[0]->getField('__kfn_UserId'), '___kpn_UserId');
            return compact('cropDetails', 'categoryName', 'bidDetails', 'dealerDetails', 'id',
             'commentRecords', 'commentUser');
        }

        $bidDetails = FarmerModel::find('Bids', $cropDetails[0]->getField('___kpn_CropPostId'),
         '__kfn_CropPostId');
        $i = 0;

        if ($bidDetails != false) {
            foreach ($bidDetails as $bidDetail) {
                $dealerDetails[$i] = FarmerModel::find('User', $bidDetail->getField('__kfn_UserId'),
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

     /**
    * Function to find a specific crop post.
    *
    * @param 1. $request - contains the record id of post.
    * @return - Returns all data of the post.
    */
    public static function acceptBid($id)
    {
        $bid = FarmerModel::find('Bids', $id, 'BidRecordId_n');
        $cropPost = FarmerModel::find('CropPost', $bid[0]->getField('__kfn_CropPostId'), '___kpn_CropPostId');
        $setAcceptedBid = FarmerModel::editPost('CropPost', $cropPost[0]->getRecordId(), $bid[0]->getField('___kpn_BidId'));
        return $cropPost[0]->getRecordId();
    }

     /**
    * Function to find a specific crop post.
    *
    * @param 1. $request - contains the record id of post.
    * @return - Returns all data of the post.
    */
    public static function createComment($request, $userId, $id)
    {
        $bid = FarmerModel::createComment('Comment', $request, $userId ,$id);
        return true;
    }
}