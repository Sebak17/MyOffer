<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main(Request $request)
    {
        return view('home.main');
    }

    public function offer(Request $request)
    {
        return view('home.offers.item');
    }

    public function offers(Request $request)
    {
        return view('home.offers.list');
    }
}
