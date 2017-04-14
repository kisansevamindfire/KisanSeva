<?php
/**
* File: CheckUser.php
* Purpose: Middleware to handle all the session data
* Date: 03-Apr-2017
* Author: Satyapriya Baral
*/

namespace App\Http\Middleware;

use Closure;

/**
* Class to check user session is there or not.
*/
class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->get('user') === Null) {
            return redirect('/');
        }
        return $next($request);
    }
}
