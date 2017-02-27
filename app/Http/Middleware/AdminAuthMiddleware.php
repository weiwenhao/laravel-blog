<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAuthMiddleware
{
    /**
     * 登录限制中间件,和前台的auth中间件作用一样,使用该中间件的用户将会在此处判断用户是否登录
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null) //验证驱动,默认使用web
    {
        if (Auth::guard($guard)->guest()) {
            //如果用户没有登录??ajax验证的返回401错误,web登录调回到主页

            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login'); //如果没有登录则跳转到登录页,否则继续前进
            }
        }
        return $next($request);
    }
}
