<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function offer_add()
    {
        return view('panel.offer_add');
    }

    public function offers_list()
    {
    	$user = Auth::user();
    	
    	$offers = Offer::where('status', '!=', 'TO_DELETE')->get();

        return view('panel.offers_list')->with('offers', $offers);
    }


    public function settings()
    {
        return view('panel.settings');
    }
}
