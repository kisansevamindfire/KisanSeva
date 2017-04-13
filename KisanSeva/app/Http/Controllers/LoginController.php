<?php
/**
* File: LoginController.php
* Purpose: Calls the UserModal class to fetch the user data
* Date: 3-Apr-2017
* Author: Satyapriya Baral
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\FarmerModel;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes;
use App\Post;
use Session;
use App\Services\LoginServices;

/**
* Class containing all functions for the login services.
*/
class LoginController extends Controller
{

    /**
    * Function to sign in to the required user home page.
    *
    * @param array Reguest - Contains all data of user for login.
    *
    * @return - Returns to the route of desired user.
    */
   public function login(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'Email' => 'required|email',
            'Password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return view('Login.login')->withErrors($validator);
        }

        $records = LoginServices::login($request->all());
        if ($records !== false) {
            if ($records[0]->getField('__kfn_UserType') != 1) {
                $request->session()->put('user', $records[0]->getField('___kpn_UserId'));
                $request->session()->put('name', $records[0]->getField('UserName_xt'));
                $request->session()->put('type', $records[0]->getField('__kfn_UserType'));
                $request->session()->put('recordId', $records[0]->getRecordId());
                if ($records[0]->getField('__kfn_UserType') == 2) {
                    return redirect('dealer');
                } elseif ($records[0]->getField('__kfn_UserType') == 3) {
                    return redirect('farmer');
                }
            }
        }
        return view('Login.login')->withErrors(['message' => 'Invalid Username or Password'],'login');
    }

    /**
    * Function to register a user.
    *
    * @param array Reguest - Contains all data of user to register.
    *
    * @return - Returns to the route of desired user.
    */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'UserType' => 'required',
            'Email' => 'required|email',
            'Name'=> 'required|min:5',
            'Password' => 'required|min:5',
            'RetypePassword' => 'required|same:Password',
            'Number' => 'required|min:10|max:10'
        ]);

        if ($validator->fails()) {
            return view('Login.register')->withErrors($validator);
        }
        else
        {
            $emailCheck = LoginServices::checkEmail($request->all());
            if ($emailCheck == false) {
                $registerUsers = LoginServices::register($request->all());
                if ($registerUsers !== false) {
                    return view('Login.register')->withErrors(['message' => 'You are Succesfully Registered'],'login');;
                }
                return view('Login.register')->withErrors(['message' => 'Something Went Wrong'],'login');
            } else {
                return view('Login.register')->withErrors(['message' => 'Email Already Exists'],'login');
            }
        }

        return view('Login.login');
    }

    /**
    * Function to signout.
    *
    * @param array Reguest - Contains all session data.
    *
    * @return - Returns to login view.
    */
    public function signout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    /**
    * Function to send email.
    *
    * @param array Reguest - Contains all email data.
    * @return - Returns to login view.
    */
    public function sendEmail(Request $request)
    {
        $dataEmail = array(
            'name' => $request->session()->get('name'),
            'email' => $request->emailto,
            'subject' => $request->subject,
            'content' => $request->content
            );
        Mail::send('email.test', $dataEmail, function($message) use ($dataEmail)
        {
            $message->to($dataEmail['email']);
            $message->subject($dataEmail['subject']);
        });
        return redirect('farmer');
    }

    /**
    * Function to go to forgot password page.
    *
    * @param array Null.
    * @return - Returns forgot password page.
    */
    public function forgot()
    {
        return view('Login.forgotpassword');
    }

    /**
    * Function to get details and make a random value for password reset.
    *
    * @param array Reguest - Contains all user data for verification.
    * @return - Returns to login view.
    */
    public function getDetails(Request $request)
    {
        $emailCheck = LoginServices::verifyEmail($request->all());
        $random = $emailCheck['str'];
        $rid = $emailCheck['rId'];

        if($emailCheck)
        {
            $editUser = LoginServices::addToken($rid, $random);
            $dataEmail = array(
                'name' => "kisansevaodisha@gmail.com",
                'email' => $request->Email,
                'subject' => "Reset Password",
                'content' => "To reset your password please visit this link: http://localhost/Project/KisanSeva/KisanSeva/public/reset/$rid/$random/$request->Email"
                );
            Mail::send('email.test', $dataEmail, function($message) use ($dataEmail)
            {
                $message->to($dataEmail['email']);
                $message->subject($dataEmail['subject']);
            });
        }
        return view('Login.forgotpassword')->withErrors(['message' => 'Reset Link Send to mail'],'login');;
    }

    /**
    * Function to check the data of reset correct or not.
    *
    * @param array Reguest - Contains all data for password reset.
    *
    * @return - Returns to the route of reset page.
    */
    public function resetpassword(Request $request)
    {
        $checkuser = LoginServices::checkEmailUser($request->email, $request->token);
        $request->session()->put('rId', $request->rId);
        if($checkuser)
        {
            return view('Login.enterpassword');
        }
        return redirect('login');
    }

    /**
    * Function to reset the password.
    *
    * @param array Reguest - Contains new password details.
    *
    * @return - Returns to the login page.
    */
    public function resetNewPassword(Request $request)
    {
        $newPasswordSet = LoginServices::editPassword($request->Password, $request->session()->get('rId'));
        if($newPasswordSet)
        {
            return redirect('login');
        }
        return redirect('login');
    }
}
