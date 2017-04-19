<?php
/**
* File: DealerModel.php
* Author: Saurabh Mehta
* Path: App/DealerModal.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/
namespace App\Model;

use App\Classes\FilemakerWrapper;
use FileMaker;

class DealerModel
{
 /**
    * Function to Show all Records in a specific layout.
    *
    * @param 1. $layout - contains name of the layout.
    * @return - Filemaker results of all records found.
    */
    public static function findAll($layout)
    {
        $fmobj = FilemakerWrapper::getConnection();
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
    * @param 1. $layout - contains name of the layout.
    *        2. $id - contains record id of specific farming tip to be displayed.
    *        3. $field - contains the field on whose basis to be searched.
    * @return - Filemaker results of Farming Tip found.
    */
    public static function find($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
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
    * @param 1. $layout - contains name of the layout.
    *        2. $id - contains record id of specific farming tip to be displayed.
    *        3. $field - contains the field on whose basis to be searched.
    * @return - Filemaker results of Farming Tip found.
    */
    public static function findBids($layout, $cropId, $userId)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        $cmd->addFindCriterion('__kfn_CropPostId', $cropId);
        $cmd->addFindCriterion('__kfn_UserId', $userId);
        $result = $cmd->execute();
        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    /**
    * Function to search for data in some find criterion.
    *
    * @param 1. $layout - contains name of the layout.
    *        2. $id - contains record id of specific farming tip to be displayed.
    *        3. $field - contains the field on whose basis to be searched.
    * @return - Filemaker results of Farming Tip found.
    */
    public static function findComment($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        $cmd->addFindCriterion($field, $id);
        $cmd->addSortRule('___kpn_CommentId', 1, FILEMAKER_SORT_DESCEND);
        $result = $cmd->execute();
        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    public static function CommentDealer($layout, $input, $userId, $id)
    {
        $fmobj = FilemakerWrapper::getConnection();

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
    * @param string $layout - contains name of the layout.
    * @param array @input - Contains all data for edit.
    * @param int $UserId - Contains the id of the user.
    *
    * @return - Boolian value if any error occured or not.
    */
    public static function editRecords($layout, $input, $userId, $filename)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $request = $fmobj->newEditCommand($layout, $userId);

        $request->setField('UserName_xt', DealerModel::Sanitize($input['Name']));
        $request->setField('UserContact_xn', DealerModel::Sanitize($input['Contact']));
        $request->setField('UserAddress_xt', DealerModel::Sanitize($input['Address']));
        if($filename != 0) {
            $request->setField('UserImage_t', $filename);
        }
        $result = $request->execute();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    public static function addBid($bid, $id, $userId)
    {
        $fmobj = FilemakerWrapper::getConnection();

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

    public static function Sanitize($value)
    {
        $retvar = trim($value);
        $retvar = strip_tags($retvar);
        $retvar = htmlspecialchars($retvar);
        return $retvar;
    }
}
