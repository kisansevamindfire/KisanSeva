<?php
/**
* File: FarmerModel.php
* Author: Satyapriya Baral
* Path: App/FMUser.php
* Purpose: fetches data from filemaker database and serves to controller
* Date: 16-03-2017
*/

namespace App\Model;

use App\Classes\FilemakerWrapper;
use FileMaker;

/**
* Class containing all functions to connect with the filemaker database.
*/
class FarmerModel
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
        $cmd = $fmobj->newFindAllCommand($layout);

        $result = $cmd->execute();
        //if any error return result not found else return data.
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
    * @return - Filemaker results of Farming Tip found.
    */
    public static function find($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        //command to find according to criterion
        $cmd->addFindCriterion($field, $id);
        $result = $cmd->execute();
        //if any error return false.
        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    /**
    * Function to search comment by find.
    *
    * @param string $layout - contains name of the layout.
    * @param int $id - contains record id of specific farming tip to be displayed.
    * @param string $field - contains the field on whose basis to be searched.
    * @return - Filemaker results of Farming Tip found.
    */
    public static function findComment($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        //command to find according to criterion
        $cmd->addFindCriterion($field, $id);
        $cmd->addSortRule('___kpn_CommentId', 1, FILEMAKER_SORT_DESCEND);
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
    * @param int $id - contains record id of specific farming tip to be displayed.
    * @param string $field - contains the field on whose basis to be searched.
    * @return - Filemaker results of Farming Tip found.
    */
    public static function findPostSorted($layout, $id, $field)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        //command to find according to criterion
        $cmd->addFindCriterion($field, $id);
        $cmd->addSortRule('___kpn_CropPostId', 1, FILEMAKER_SORT_DESCEND);
        $result = $cmd->execute();
        //if any error return false.
        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }

    /**
    * Function to search for data in some find criterion.
    *
    * @param string $layout - contains name of the layout.
    * @param string $cropName - contains crop name of the crop to find.
    * @param int $user - contains the id of the user.
    * @return - Filemaker results of posts found.
    */
    public static function findPosts($layout, $cropName, $user)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $cmd = $fmobj->newFindCommand($layout);
        //command to find according to criterion
        $cmd->addFindCriterion('cropName_t', $cropName);
        $cmd->addFindCriterion('__kfn_UserId', $user);
        $result = $cmd->execute();

        if (!FileMaker::isError($result)) {
            return $result->getRecords();
        }
        return false;
    }
    /**
    * Function to Create a Post.
    *
    * @param string $layout - contains name of the layout.
    * @param array $input - Contains all the data to be inserted in the record.
    * @param int $UserId - Contains the id of the user.
    * @param string $CropName - Contains the name of the crop.
    * @return - Boolian value if any error occured or not.
    */
    public static function addPost($layout, $input, $UserId, $CropName)
    {
        $newDate = date("m/d/Y", strtotime($input['ExpiryTime']));
        $fmobj = FilemakerWrapper::getConnection();

        if ($input['Weight'] == 0) {
            $str = $input['Quantity'].' Kg';
        } else {
            $str = $input['Quantity'].' Ton';
        }

        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_CropId', FarmerModel::sanitize($input['Crop']));
        $request->setField('CropPrice_xn', FarmerModel::sanitize($input['BasePrice']));
        $request->setField('CropName_t', FarmerModel::sanitize($CropName));
        $request->setField('CropExpiryTime_xi', FarmerModel::sanitize($newDate));
        $request->setField('__kfn_UserId', FarmerModel::sanitize($UserId));
        $request->setField('Quantity_xn', FarmerModel::sanitize($str));
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return $request->getRecordId();
        }
        return false;
    }

    /**
    * Function to add Image to crop post.
    *
    * @param string $layout - contains name of the layout.
    * @param string $filename - Contains the name of thr image file.
    * @param int postId - contains the id of the post.
    * @return - Boolian value if any error occured or not.
    */
    public static function addImage($layout, $filename, $postId)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to create record of image.
        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_CropPostId', $postId);
        $request->setField('MediaPostUrl_t', $filename);
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return false;
    }


    /**
    * Function to edit the details of user.
    *
    * @param string $layout - contains name of the layout.
    * @param array @input - Contains all data for edit.
    * @param int $UserId - Contains the id of the user.
    * @param string $filename - Contains the name of profile image.
    * @return - Boolian value if any error occured or not.
    */
    public static function editRecords($layout, $input, $userId, $filename)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $request = $fmobj->newEditCommand($layout, $userId);
        //setting fields for edit.
        $request->setField('UserName_xt', FarmerModel::sanitize($input['Name']));
        $request->setField('UserContact_xn', FarmerModel::sanitize($input['Contact']));
        $request->setField('UserAddress_xt', FarmerModel::sanitize($input['Address']));
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
    * Function to edit a post.
    *
    * @param string $layout - contains name of the layout.
    * @param int $postRecordId - Contains the id of the post.
    * @param int $id - Contains the bid id.
    * @return - Boolian value if any error occured or not.
    */
    public static function editPost($layout, $postRecordId, $id)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $request = $fmobj->newEditCommand($layout, $postRecordId);

        $request->setField('Sold_n', 1);
        $request->setField('__kfn_AcceptedBid', $id);
        $result = $request->execute();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to Create a comment.
    *
    * @param string $layout - contains name of the layout.
    * @param array $input - Contains all the data to be inserted in the record.
    * @param int $UserId - Contains the id of the user.
    * @param int $id - Contains the id of the post.
    * @return - Boolian value if any error occured or not.
    */
    public static function createComment($layout, $input, $userId, $id)
    {
        $fmobj = FilemakerWrapper::getConnection();
        //command to create new comment record.
        $request = $fmobj->createRecord($layout);
        $request->setField('__kfn_CropPostId', $id);
        $request->setField('__kfn_UserId', $userId);
        $request->setField('CommentData_xt', FarmerModel::sanitize($input['commentData']));
        $result = $request->commit();

        if (!FileMaker::isError($result)) {
            return true;
        }
        return $result->getMessage();
    }

    /**
    * Function to sanitize the value that will be stored in the database.
    *
    * @param mixed $value - contains the value to be sanitized.
    * @return - Returns the value after sanitizing.
    */
    public static function delete($id)
    {
        $fmobj = FilemakerWrapper::getConnection();
        $deleteRecord = $fmobj->newDeleteCommand('CropPost', $id);
        $result = $deleteRecord->execute();
        return $result;
    }

    /**
    * Function to sanitize the value that will be stored in the database.
    *
    * @param mixed $value - contains the value to be sanitized.
    * @return - Returns the value after sanitizing.
    */
    public static function sanitize($value)
    {
        $retvar = trim($value);
        $retvar = strip_tags($retvar);
        $retvar = htmlspecialchars($retvar);
        return $retvar;
    }
}
