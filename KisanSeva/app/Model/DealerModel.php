<?php
/**
* File: DealerModel.php
* Author: Saurabh Mehta, Satyapriya Baral
* Path: App/DealerModal.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/
namespace App\Model;

use App\Classes\FilemakerWrapper;
use FileMaker;

/**
* Class containing all functions to connect to filemaker database to get results.
*/
class DealerModel
{
 /**
    * Function to Show all Records in a specific layout.
    *
    * @param string $layout - contains name of the layout.
    * @return - Filemaker results of all records found.
    */
    public static function findAll($layout)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to find all data.
        $cmd = $fmobj->newFindAllCommand($layout);
        $result = $cmd->execute();

        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }

    /**
    * Function to search for data in some find criterion.
    *
    * @param string $layout - contains name of the layout.
    * @param int $id - contains record id of specific farming tip to be displayed.
    * @param string $field - contains the field on whose basis to be searched.
    * @return - Filemaker results of all result found.
    */
    public static function find($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        //set criterion to find
        $cmd->addFindCriterion($field, $id);
        $result = $cmd->execute();

        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    /**
    * Function to search for data in some find criterion.
    *
    * @param string $layout - contains name of the layout.
    * @param int $cropId - contains record id of specific crop.
    * @param int $userId - contains the id of the user
    * @param string $field1 - contains the first field on whose basis to be searched.
    * @param string $field2 - contains the second field on whose basis ro be searched.
    * @return - Filemaker result of all details found.
    */
    public static function findDetails($layout, $cropId, $userId, $field1, $field2)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        //set criterion to find
        $cmd->addFindCriterion($field1, $cropId);
        $cmd->addFindCriterion($field2, $userId);
        $result = $cmd->execute();

        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    /**
    * Function to search all comments in sorted order.
    *
    * @param string $layout - contains name of the layout.
    * @param int $id - contains record id of the crop post.
    * @param string $field - contains the field on whose basis to be searched.
    * @return - Filemaker result of all comments found.
    */
    public static function findComment($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        $cmd->addFindCriterion($field, $id);
        //sort records in descending order
        $cmd->addSortRule('___kpn_CommentId', 1, FILEMAKER_SORT_DESCEND);
        $result = $cmd->execute();

        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    /**
    * Function to create new comment.
    *
    * Author - Satyapriya Baral
    * @param string $layout - contains name of the layout.
    * @param array $input - contains all comment data.
    * @param int $userId - contains the id of user who commented.
    * @param int $id - contains the id of crop on which comment is made.
    * @return - Boolian result of success or failure.
    */
    public static function commentDealer($layout, $input, $userId, $id)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to create record
        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_CropPostId', $id);
        $request->setField('__kfn_UserId', $userId);
        $request->setField('CommentData_xt', $input['commentData']);
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to edit the details of user.
    *
    * Author - Satyapriya Baral
    * @param string $layout - contains name of the layout.
    * @param array @input - Contains all data for edit.
    * @param int $UserId - Contains the id of the user.
    * @param string $filename - Contains the name of the image file.
    * @return - Boolian value if any error occured or not.
    */
    public static function editRecords($layout, $input, $userId, $filename)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to edit records in layout
        $request = $fmobj->newEditCommand($layout, $userId);
        //edit the required fields
        $request->setField('UserName_xt', DealerModel::sanitize($input['Name']));
        $request->setField('UserContact_xn', DealerModel::sanitize($input['Contact']));
        $request->setField('UserAddress_xt', DealerModel::sanitize($input['Address']));
        if ($filename != 0) {
            $request->setField('UserImage_t', $filename);
        }
        $result = $request->execute();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to add new bid.
    *
    * Author - Satyapriya Baral
    * @param int $bid - contains the bid price.
    * @param int $id - contains the id of the crop on which bid is made.
    * @param int $UserId - Contains the id of the user.
    * @return - Boolian value if any error occured or not.
    */
    public static function addBid($bid, $id, $userId)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to create new bid record
        $request = $fmobj->createRecord('Bids');
        $request->setField('__kfn_CropPostId', $id);
        $request->setField('BidPrice_xn', $bid);
        $request->setField('__kfn_UserId', $userId);
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to add rating of user.
    *
    * Author - Satyapriya Baral
    * @param int $postId - contains the id of the crop post.
    * @param int $rating - contains the value of rating.
    * @param int $UserId - contains the id of user.
    * @return - Boolian value if any error occured or not.
    */
    public static function addRating($postId, $rating, $userId)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to create new rating
        $request = $fmobj->createRecord('Rating');
        $request->setField('__kfn_PostId', $postId);
        $request->setField('Rating_n', $rating);
        $request->setField('__kfn_UserId', $userId);
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to edit user Rating.
    *
    * Author - Satyapriya Baral
    * @param int $recordId - contains the record id of user.
    * @param int $totalRating - contains the rating of user.
    * @param int $totalRated - contains the total no of users rated.
    * @return - Boolian value if any error occured or not.
    */
    public static function editUserRating($recordId, $totalRating, $totalRated)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $request = $fmobj->newEditCommand('User', $recordId);
        //set fields to edit
        $request->setField('UserRating_n', $totalRating);
        $request->setField('TotalRated_n', $totalRated);
        $result = $request->execute();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to sanitize all data.
    *
    * Author - Satyapriya Baral
    * @param int $value - contains the value to be sanitized.
    * @return - the value after sanitize.
    */
    public static function sanitize($value)
    {
        $retvar = trim($value);
        $retvar = strip_tags($retvar);
        $retvar = htmlspecialchars($retvar);
        return $retvar;
    }
}
