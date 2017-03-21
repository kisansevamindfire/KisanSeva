<?php
/**
* File: UsersController.php
* Path: App/Http/Controllers/FMUser.php
* Purpose: Calls the FMUser class to fetch the data from filemaker database
* Date: 16-03-2017
* Author: R S DEVI PRASAD
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use App\FMUser;
use App\Http\Requests;
use App\Classes;
class UsersController extends Controller
{
    /*
     * Show all the list of users in the database
     * @param void
     * @return list of users
     */
    public function index()
    {
      //  $records = new FMUser();
       // $records->showall();
       //$records = Task::all();
      //  return view('test', compact('records'));
        $records = FMUser::showAll();
        return view('test', compact('records'));
        $datas = FMUser::showAll();
        return view('test', compact('datas'));

    }
    public function index1()
    {
      //  $records = new FMUser();
       // $records->showall();
       //$records = Task::all();
      //  return view('test', compact('records'));

        $datas = FMUser::showAll();
        return view('test', compact('datas'));
    }

}