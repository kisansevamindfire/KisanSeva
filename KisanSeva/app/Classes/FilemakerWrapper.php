<?php
/**
* File: FilemakerWrapper.php
* Author: Satyapriya Baral
* Path: App/Classes/FilemakerWrapper.php
* Purpose: Connects to filemaker database
* Date: 16-03-2017
*/

namespace App\Classes;
use FileMaker;
class FilemakerWrapper
{
    public static function getConnection()
    {
        return new FileMaker(
        env("DB_DATABASE"),
        env("DB_HOST"),
        env("DB_USERNAME"),
        env("DB_PASSWORD")
        );
    }
}