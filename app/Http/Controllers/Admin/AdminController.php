<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    //
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
//        $this->middleware('admin');
            $this->middleware('auth.admin:admin'); //使用限制登录中间件,并传递了一个admin的实参,可以在中间件中被接收
    }

    public function index()
    {
        return view('admin.index');
    }
}
