<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('USER_LOGIN')) {
           
        }else{
            $request->session()->flash('error', 'Access Denied Aunauthorized Request');
            return redirect('Login');
        }
        return $next($request);
    }
}
