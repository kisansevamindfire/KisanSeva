<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        //if (Auth::guard($guard)->guest()) {
       //     if ($request->ajax() || $request->wantsJson()) {
       //     } else {
       //         return redirect()->guest('login');
       //     }
      //  }

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
