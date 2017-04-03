<?php
/**
* File: LoginController.php
* Purpose: Calls the LoginUser class to fetch the data from filemaker 
database
* Date: 20-Mar-2017
* Author: Saurabh Mehta
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UserModal;
use App\Http\Requests;
use App\Classes;
use Illuminate\Routing\Controller;
class LoginController extends Controller
{   
    public function loginUser() {
        return view("Login.login");
    }
    public function registerUser() {
        return view('Login.register');
/*    $input = $_POST;
    $returnValue = UserModal::addUser('User',$input);
    if ($returnValue) {
        return redirect('/');
    }
    return back();
    }
*/
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
                