<?php
/**
* File: FMUser.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 18/03/2017
* Author: Saurabh Mehta
*/
namespace App;
use App\Classes\FilemakerWrapper;
use FileMaker;
class FMUser
{
    public static function showAll()
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindAllCommand('User');
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }

    public static function ViewTips()
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindAllCommand('Tips');
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }
}