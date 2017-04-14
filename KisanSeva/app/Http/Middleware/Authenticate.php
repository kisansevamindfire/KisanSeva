<?php
/**
* File: Authenticate.php
* Purpose: Middleware to handle all the session data of user
* Date: 03-Apr-2017
* Author: Satyapriya Baral
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
* Class to check user session is there or not.
*/
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
         if($request->session()->get('user') != Null) {
            if($request->session()->get('type') == 2) {
                return redirect('dealer');
            } else if($request->session()->get('type') == 3) {
                return redirect('farmer');
            } else {
                return $next($request);
            }
         }
        return $next($request);
    }
}
