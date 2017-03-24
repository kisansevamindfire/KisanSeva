<<?php
/**
* File: FarmerController.php
* Purpose: Calls the FMUser class to fetch the data required for farmer pages.
* Date: 24/03/2017
* Author: SatyaPriya Baral
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FMUser;
use App\Http\Requests;
use App\Classes;
class FarmerController extends Controller
{
    /*
     * Show all the list of users in the database
     * @param void
     * @return list of users
     */
    public function index()
    {
        $records1 = FMUser::showAll('User');
        return view('test', compact('records'));
    }
}
