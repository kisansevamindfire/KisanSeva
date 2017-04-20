<?php
/**
* File: DealerServices.php
* Purpose: Calls the dealerModel to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: Saurabh Mehta, Satyapriya Baral
*/
namespace App\Services\Dealer;

use Illuminate\Http\Request;
use App\Model\DealerModel;
use App\Http\Requests;
use App\Classes;
use Filemaker;

/**
* Class containing all functions for the services of dealer.
*/
class DealerServices
{

    /**
    * Function to get all data for dashboard.
    *
    * @param int $userId - contains the id of user.
    * @return - Returns a boolian value if post made or not.
    */
    public static function dashboardDataDealer($userId)
    {
        $posts = DealerModel::find('CropPost', $userId, '__kfn_UserId');
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
                    $bidAccepted = DealerModel::find('Bids', $post->getField('__kfn_AcceptedBid'), '___kpn_BidId');
                    $totalEarning = $totalEarning + $bidAccepted[0]->getField('BidPrice_xn');
                } elseif ($expire_time < $today_time) {
                    $postExpired++;
                } else {
                    $postActive++;
                }
            }
            $lastPostTime = $posts[$count-1]->getField('PublishedTime_t');
        }

        $countPost = array(
            $totalPosts, $postSold, $lastPostTime, $postActive, $postExpired, $totalEarning
        );

        return compact('countPost');
    }

    /**
    * Function to get all post Data.
    *
    * Author : Satyapriya Baral
    * @param array $request - contains all post related data.
    * @param int $user - contains id of the user.
    * @return - Returns a all records posted.
    */
    public static function findAllPosts($request, $user)
    {
        $crops = DealerModel::findAll('CropPost');
        //if crops found get all crop details
        if ($crops !== false) {
            $i=0;
            foreach ($crops as $crop) {
                $cropRecord = DealerModel::Find(
                    'Crop',
                    $crop->getField('__kfn_CropId'),
                    '___kpn_CropId'
                );
                //get all crop details of the post
                $cropDetails[$i] = [ $cropRecord[0]->getField('CropName_xt'),
                $cropRecord[0]->getField('___kpn_CropId')];
                $categoryRecord = DealerModel::Find('Category', $cropRecord[0]->getField('__kfn_CategoryId'), '___kpn_CategoryId');
                //find all the bid details
                $bidDetails[$i] = DealerModel::findDetails('Bids', $crop->getField('___kpn_CropPostId'), $user, '__kfn_CropPostId', '__kfn_UserI');
                $categoryDetails[$i] = [$categoryRecord[0]->getField('CategoryName_xt')];
                $i = $i + 1;
            }
            //set all post details in an array.
                $PostRecords = array(
                    $crops, $cropDetails, $categoryDetails, $bidDetails
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
    public static function profileDealer($userId)
    {
        //find all the profile details of dealer.
        $profileDataDealer = DealerModel::find('User', $userId, '___kpn_UserId');
        if ($profileDataDealer != false) {
            return $profileDataDealer;
        }
        return false;
    }

    /**
    * Function to find a specific crop post.
    *
    * Author : Satyapriya Baral
    * @param int $id - contains the record id of post.
    * @param int $userId - contains id of user.
    * @return - Returns all data of the post.
    */
    public static function getadDetails($id, $userId)
    {
        $cropDetails = DealerModel::find('CropPostDetailsPortal', $id, 'RecordId_n');
        $cropRecord = $cropDetails[0]->getRelatedSet('Crop 2');
        //get the category details of crop
        $categoryName = DealerModel::find('Category', $cropRecord[0]->getField('Crop 2::__kfn_CategoryId'), '___kpn_CategoryId');
        //get all the comment details of post
        $commentRecords = DealerModel::findComment('Comment', $cropDetails[0]->getField('___kpn_CropPostId'), '__kfn_CropPostId');
        //get all the related image of post
        $imagePosts = $cropDetails[0]->getRelatedSet('Crop_CropPost_MediaPost');
        $userPostDetails = DealerModel::find('User', $cropDetails[0]->getField('__kfn_UserId'), '___kpn_UserId');

        //if any comment found set all data to an array
        if (!empty($commentRecords)) {
            $j = 0;
            foreach ($commentRecords as $commentRecord) {
                $commentUser[$j] = DealerModel::find('User', $commentRecord->getField('__kfn_UserId'), '___kpn_UserId');
                $j++;
            }
        } else {
            $commentRecords = 0;
            $commentUser = 0;
        }
        if (FileMaker::isError($imagePosts)) {
            $imagePosts = 0;
        }

        //get all rating data of farmer.
        $ratingData = DealerModel::findDetails('Rating', $cropDetails[0]->getField('___kpn_CropPostId'), $userId, '__kfn_PostId', '__kfn_UserId');
        $bidDetails = DealerModel::findDetails('Bids', $cropDetails[0]->getField('___kpn_CropPostId'), $userId, '__kfn_CropPostId', '__kfn_UserId');
        //send all data by an array
        return compact('cropDetails', 'categoryName', 'bidDetails', 'id', 'commentRecords', 'commentUser', 'imagePosts', 'userPostDetails', 'ratingData');
    }

    /**
    * Function to make comment record for delaer.
    *
    * @param array $request - contains all data of comment.
    * @param int $userId - contains id of the user.
    * @param int $id - contains id of the crop on which comment made
    * @return - Returns boolian value of comment made or not.
    */
    public static function commentDealer($request, $userId, $id)
    {
        $bid = DealerModel::commentDealer('Comment', $request, $userId, $id);
        return true;
    }

    /**
    * Function to edit profile of delaer.
    *
    * Author : Satyapriya Baral
    * @param array $request - contains all profile edit details.
    * @param int $userId - contains id of the user.
    * @param string $filename - contains the name of the profile image file.
    * @return - Returns boolian value of true or false.
    */
    public static function editProfileDealer($request, $userId, $filename)
    {
        //go to edit command to edit the profile of user.
        $editProfileDealer = DealerModel::editRecords('User', $request, $userId, $filename);

        if ($editProfileDealer != true) {
            return false;
        }

        return true;
    }

    /**
    * Function to add bid.
    *
    * Author : Satyapriya Baral
    * @param int bid - contains the value of bid made.
    * @param int $userId - contains id of the user.
    * @param int id - contains the record id of the post on which bid is made.
    * @return - Returns boolian value if bid succesful.
    */
    public static function addBid($bid, $id, $userId)
    {
        $addBid = DealerModel::addBid($bid, $id, $userId);
        return true;
    }

    /**
    * Function to add rating.
    *
    * Author : Satyapriya Baral
    * @param mixed $request - contains all data of rating.
    * @return - Returns to the ad details view.
    */
    public static function addRating($farmerId, $postId, $rating, $userId)
    {
        //create a record of new rating made
        DealerModel::addRating($postId, $rating, $userId);
        $userRated = DealerModel::find('User', $farmerId, '___kpn_UserId');

        //set the user rating
        if ($userRated[0]->getField('TotalRated_n') == "") {
            DealerModel::editUserRating($userRated[0]->getRecordId(), $rating, 1);
        } else {
            //calculate the avg rating of user.
            $calculate = $userRated[0]->getField('TotalRated_n') * $userRated[0]->getField('UserRating_n');
            $totalRated = $userRated[0]->getField('TotalRated_n') + 1;
            $totalRating = ($calculate + $rating) / $totalRated;
            DealerModel::editUserRating($userRated[0]->getRecordId(), $totalRating, $totalRated);
        }
    }
}
