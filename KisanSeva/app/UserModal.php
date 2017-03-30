<?php
/**
* File: UserModal.php
* Author: Saurabh Mehta
* Path: App/UserModal.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/
namespace App;
use App\Classes\FilemakerWrapper;
use FileMaker;
class UserModal
{
     public static function addUser($layout, $input)
    {
        $fmobject = FilemakerWrapper::getConnection();
        // storing the data into the database.
        $request = $fmobject->createRecord($layout);
        $request->setField('___kfn_UserType', $input['UserType']);
        $request->setField('UserName_xt', $input['UserName']);
        $request->setField('UserContact_xn', $input['UserContact']);
        $request->setField('UserAddress_xt', $input['UserAddress']);
        $request->setField('UserEmail_xt', $input['UserEmail']);
        $request->setField('UserPassword_xt', $input['UserPassword'] );
        
        $result = $request->commit();
        if (!FileMaker::isError($result)) {
            return true;
        }
        return false;
    }
 

/*  public static function registerUser($layout,$UserType,$UserName,
    $UserContact,$UserAddress,$UserEmail,$UserPassword) 
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->registerUser($layout);
        $cmd->setField('___kfn_UserType', $UserType);
        $cmd->setField('UserName_xt', $UserName);
        $cmd->setField('UserContact_xn', $UserContact);
        $cmd->setField('UserAddress_xt', $UserAddress);
        $cmd->setField('UserEmail_xt', $UserEmail);
        $cmd->setField('UserPassword_xt', $UserPassword);
        $result = $cmd->commit();

        if (FileMaker::isError($result)) { 
            return false;
        } else {
            return true;
        }

    }*/

}
