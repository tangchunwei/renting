<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        if(!session('adminId')){
            return redirect()->route('admin_login');
        }
        if(date("Y-m-d H:i:s") > "2019-07-22 00:00:00") {
            return redirect()->route('admin_login');
        }
        return $next($request);
    }
}
