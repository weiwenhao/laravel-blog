<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';


    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //如果用户已经登录就跳转到主页
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    protected function guard()
    {
//        dd(auth()->guard('admin')); //SessionGuard {#311 ▼ 返回了一个guard实例
                                        #name: "admin"
        return auth()->guard('admin');
    }

    //重构登录表单
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * 重写登录logout方法
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) //what???为什么 \Request 和 Illuminate\Http\Request; 不一样??
    {

        $this->guard()->logout(); //调用退出登录的方法

        $request->session()->flush(); //清空session

        $request->session()->regenerate();

        return redirect('/admin/login'); //重定向
    }


}
