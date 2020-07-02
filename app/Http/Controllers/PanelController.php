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
        
        $offers = Offer::where('user_id', $user->id)->where('status', '!=', 'TO_DELETE')->get();

        return view('panel.offers_list')->with('offers', $offers);
    }

    public function favorites_list()
    {
        $user = Auth::user();

        $offers = array();

        $favs = json_decode($user->getFavorites()->offers, true);

        foreach ($favs as $id) {
            $offer = Offer::where('id', $id)->where('status', 'VISIBLE')->first();

            if ($offer == null) {
                continue;
            }

            array_push($offers, $offer);
        }

        return view('panel.favorites')->with('offers', $offers);
    }


    public function settings()
    {
        return view('panel.settings');
    }
}
