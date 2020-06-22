<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main(Request $request) {
    	return view('home.main');
    }
}
