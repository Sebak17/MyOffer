<?php

namespace App\Http\Controllers;

class AdminAuthController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function not_authorized()
    {
        return view('admin.not_authorized');
    }

    public function auth_signin()
    {
        return view('admin.signin');
    }

}
