<?php
/**
* File: DealerModal.php
* Author: Saurabh Mehta
* Path: App/DealerModal.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/
namespace App;
use App\Classes\FilemakerWrapper;
use FileMaker;
class DealerModal
{	
	public static function FindAll( $layout )
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindAllCommand( $layout );
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }

    public static function Find( $layout , $id , $field )
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand( $layout );
        $cmd->addFindCriterion( $field , $id );
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }


}