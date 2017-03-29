<?php
/**
* File: FMUser.php
* Author: Satyapriya Baral
* Path: App/FMUser.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/
namespace App;
use App\Classes\FilemakerWrapper;
use FileMaker;
class FMUser
{
    public static function showAll($layout)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindAllCommand($layout);
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }
    /*public static function create()
    {
        $fmobj = FilemakerWrapper::getConnection();
        $record = $fm->createRecord('User');
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    } */
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
    public static function Find( $layout , $id )
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand( $layout );
        $cmd->addFindCriterion('___kpn_TipId',$id);
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return ["No", "records", "Found", $result->getMessage()];
    }
    public static function FindCrop( $layout , $id )
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand( $layout );
        $cmd->addFindCriterion('__kfn_CategoryId',$id);
        $result = $cmd->execute();
        if(!FileMaker::isError($result)) {
            $records = $result->getRecords();
            $i = 0 ;
            $array = [];
            foreach ($records as $record) {
                $array[$i] = [$record->getField('CropName_xt')];
                $i = $i+1;
            }
            return $array;
        }
        return ["No", "records", "Found", $result->getMessage()];
    }
}