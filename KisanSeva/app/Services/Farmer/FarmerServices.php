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

/**
* Class containing all functions for the services of farmer.
*/
class FarmerServices
{

    /**
    * Function to get All Farming Tips Data.
    *
    * @param int tipId - Contains id of a specific tip.
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
    * @param int $id - contains id of the Category and all session data.
    * @return - Filemaker results of Crops Found under Category.
    */
    public static function findCrops($id)
    {
        $crops = FarmerModel::find('Crop', $id, '__kfn_CategoryId');
        //setting all data of crop in an array.
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
    * @param int $id - contains record id of specific farming tip to be displayed.
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
    * @param array $request - contains all data of the post to be created.
    * @param int $userId - contains the id of the user who made the post.
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
    * Function to get all data for dashboard.
    *
    * @param int $userId - contains the id of user.
    * @return - Returns a boolian value if post made or not.
    */
    public static function findDashboardData($userId)
    {
        $posts = FarmerModel::find('CropPost', $userId, '__kfn_UserId');
        //get current date.
        date_default_timezone_set('Asia/Kolkata');
        $date = date("m/d/Y");
        $time = date("h:i:sa");
        $today_time = strtotime($date);

        //count the no of posts, the posts sold, expired and earnings.
        $count = count($posts);
        $lastPostTime = "No Posts Made Yet";
        $totalPosts = 0;
        $postSold = 0;
        $postActive = 0;
        $postExpired = 0;
        $totalEarning = 0;
        if ($posts) {
            foreach ($posts as $post) {
                $expire_time = strtotime($post->getField('CropExpiryTime_xi'));
                $totalPosts++;
                if ($post->getField('Sold_n') == 1) {
                    $postSold++;
                    $bidAccepted = FarmerModel::find('Bids', $post->getField('__kfn_AcceptedBid'), '___kpn_BidId');
                    $totalEarning = $totalEarning + $bidAccepted[0]->getField('BidPrice_xn');
                }
                elseif ($expire_time < $today_time) {
                    $postExpired++;
                } else { $postActive++; }
            }
            $lastPostTime = $posts[$count-1]->getField('PublishedTime_t');
        }

        $countPost = array(
            $totalPosts,
            $postSold,
            $lastPostTime,
            $postActive,
            $postExpired,
            $totalEarning
        );

        return compact('countPost');
    }

    /**
    * Function to get all posts of the user.
    *
    * @param array Reguest - Contains all session data to find the post.
    * @param int $user - Contains the id of user.
    * @return - Array of all post data.
    */
    public static function findAllPosts($request, $user)
    {
        $posts = FarmerModel::findPostSorted('CropPost', $user, '__kfn_UserId');

        //if any data found create an array and insert all post details.
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
    * @param int $userId - contains id of the user.
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
    * Function to count the number of posts.
    *
    * @param int $userId - contains id of the user.
    * @return - Returns all profile details of user.
    */
    public static function postCount($userId)
    {
        $posts = FarmerModel::find('CropPost', $userId, '__kfn_UserId');

        //count the no of posts and the posts sold
        $count = count($posts);
        $lastPostTime = "No Posts Made Yet";
        $totalPosts = 0;
        $postSold = 0;
        if ($posts) {
            foreach ($posts as $post) {
                $totalPosts++;
                if ($post->getField('Sold_n') === 1)
                    { $postSold++; }
            }
            $lastPostTime = $posts[$count-1]->getField('PublishedTime_t');
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
    * @param array $request - contains all data of the post to be created.
    * @param $user - contains the id of the user who made the post.
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
    * @param array $request - contains the record id of post.
    * @return - Returns all data of the post.
    */
    public static function findCropDetails($id)
    {
        //get all crop details
        $cropDetails= FarmerModel::find('CropPostDetailsPortal', $id , 'RecordId_n');
        $cropRecord = $cropDetails[0]->getRelatedSet('Crop 2');
        //get all category details
        $categoryName = FarmerModel::find('Category', $cropRecord[0]->getField('Crop 2::__kfn_CategoryId'),
         '___kpn_CategoryId');
        //get all comment details
        $commentRecords = FarmerModel::findComment('Comment', $cropDetails[0]->getField('___kpn_CropPostId'),
         '__kfn_CropPostId');

        //if no comment is found set comment 0
        if(!empty($commentRecords)) {
            $j = 0;
            foreach ($commentRecords as $commentRecord) {
                $commentUser[$j] = FarmerModel::find('User', $commentRecord->getField('__kfn_UserId'),
                 '___kpn_UserId');
                $j++;
            }
        } else { $commentRecords = 0; $commentUser = 0; }

        //check if the crops are sold or not.
        if ($cropDetails[0]->getField('Sold_n') == 1) {
            $bidDetails = FarmerModel::find('Bids', $cropDetails[0]->getField('__kfn_AcceptedBid'), '___kpn_BidId');
            $dealerDetails[0] = FarmerModel::find('User', $bidDetails[0]->getField('__kfn_UserId'), '___kpn_UserId');
            return compact('cropDetails', 'categoryName', 'bidDetails', 'dealerDetails', 'id',
             'commentRecords', 'commentUser');
        }
        //search for any bids on post
        $bidDetails = FarmerModel::find('Bids', $cropDetails[0]->getField('___kpn_CropPostId'),
         '__kfn_CropPostId');
        $i = 0;
        //Check if any bids made or not.
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
    * Function to accept a bid.
    *
    * @param int $id - contains the record id of post.
    * @return - Returns all data of the Bid.
    */
    public static function acceptBid($id)
    {
        $bid = FarmerModel::find('Bids', $id, 'BidRecordId_n');
        //search for the bids
        $cropPost = FarmerModel::find('CropPost', $bid[0]->getField('__kfn_CropPostId'),
            '___kpn_CropPostId');
        $setAcceptedBid = FarmerModel::editPost('CropPost', $cropPost[0]->getRecordId(),
            $bid[0]->getField('___kpn_BidId'));

        return $cropPost[0]->getRecordId();
    }

     /**
    * Function to create a comment.
    *
    * @param array $request - contains all data of the comment.
    * @param int userId - contains the id of user.
    * @param int $id - contains the id of post.
    * @return - Returns a boolian value.
    */
    public static function createComment($request, $userId, $id)
    {
        $bid = FarmerModel::createComment('Comment', $request, $userId ,$id);
        return true;
    }
}