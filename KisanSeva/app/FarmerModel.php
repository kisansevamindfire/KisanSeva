<?php
/**
* File: FarmerModel.php
* Author: Satyapriya Baral
* Path: App/FMUser.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/

namespace App;

use App\Classes\FilemakerWrapper;
use FileMaker;

class FarmerModel
{

    /**
    * Function to Show all Records in a specific layout.
    *
    * @param 1. $layout - contains name of the layout.
    * @return - Filemaker results of all records found.
    */
    public static function userDetails($layout, $input)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        $cmd->addFindCriterion('UserEmail_xt', '=='.$input['userEmail']);
        $cmd->addFindCriterion('UserPassword_xt', $input['userPassword']);
        $result = $cmd->execute();
        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

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
        return ["No", "records", "Found", $result->getMessage()];
    }

    /**
    * Function to Create a Post.
    *
    * @param 1. $layout - contains name of the layout.
    *        2. $input - Contains all the data to be inserted in the record.
    * @return - Boolian value if any error occured or not.
    */
    public static function addPost($layout, $input)
    {
        $newDate = date("m/d/Y", strtotime($input['ExpiryTime']));
        $fmobj = FilemakerWrapper::getConnection();
        if ($input['Weight'] == 0) {
            $str = $input['Quantity'].' Kg';
        } else {
            $str = $input['Quantity'].' Ton';
        }
        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_CropId', $input['Crop']);
        $request->setField('CropPrice_xn', $input['BasePrice']);
        $request->setField('CropExpiryTime_xi', $newDate);
        $request->setField('Quantity_xn', $str);
        $result = $request->commit();
        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }
}
