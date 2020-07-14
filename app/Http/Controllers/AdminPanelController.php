<?php

namespace App\Http\Controllers;

class AdminPanelController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function panel()
    {
        return view('admin.panel.dashboard');
    }

}
