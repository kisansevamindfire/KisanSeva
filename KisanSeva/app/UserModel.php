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

class UserModel
{

    /**
    * Function to Show all user Details.
    *
    * @param 1. $layout - contains name of the layout.
    *        2. $input - contains all the fields to search the user
    * @return - Filemaker results of all records found.
    */
    public static function userDetails($layout, $input)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        $cmd->addFindCriterion('UserEmail_xt', '=='.$input['Email']);
        $cmd->addFindCriterion('UserPassword_xt', $input['Password']);
        $result = $cmd->execute();
        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }
    /**
    * Function to Create a User.
    *
    * @param 1. $layout - contains name of the layout.
    *        2. $input - Contains all the data to be inserted in the record.
    * @return - Boolian value if any error occured or not.
    */
    public static function addUsers($layout, $input)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_UserType', $input['UserType']);
        $request->setField('UserName_xt', $input['Name']);
        $request->setField('UserPassword_xt', $input['Password']);
        $request->setField('UserContact_xn', $input['Number']);
        $request->setField('UserAddress_xt', $input['Address']);
        $request->setField('UserEmail_xt', $input['Email']);
        $request->setField('EnableDisable_xn', 0);
        $request->setField('UserRating_n', 0);
        $result = $request->commit();
        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to search for data in some find criterion.
    *
    * @param 1. $layout - contains name of the layout.
    *        2. $id - contains record id of specific farming tip to be displayed.
    *        3. $field - contains the field on whose basis to be searched.
    * @return - Boolian value if the result is found or not.
    */
    public static function find($layout, $data, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        $cmd->addFindCriterion($field, "==".$data);
        $result = $cmd->execute();
        if (!FileMaker::isError($result)) {
            return true;
        }
        return false;
    }

}
