<?php
/**
* File: DealerModel.php
* Author: Saurabh Mehta
* Path: App/DealerModal.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/
namespace App;

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
    
    public static function createCommentDealer($layout, $input, $userId, $id)
    {
        $fmobj = FilemakerWrapper::getConnection();

        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_CropPostId', $id);
        $request->setField('__kfn_UserId', $userId);
        $request->setField('CommentData_xt', $input['commentDataDealer']);
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }
}
