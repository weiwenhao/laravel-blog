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
            $this->middleware('auth.admin:admin');
    }

    public function index()
    {
        return view('admin.index');
    }
}
