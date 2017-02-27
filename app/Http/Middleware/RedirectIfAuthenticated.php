<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            //如果已经登录,再次进入登录界面或者注册界面,则 根据不同 guard 跳转到不同的页面
            $url = $guard ? "/$guard":'/';
            return redirect($url);
        }

        return $next($request);
    }
}
