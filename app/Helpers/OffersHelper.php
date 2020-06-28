<?php

namespace App\Helpers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OffersHelper
{

    public static function addOfferToHistory(Request $request, Offer $offer)
    {

        $offersHistory = $request->session()->get('OFFERS_SEEN_HISTORY', []);

        if (in_array($offer->id, $offersHistory)) {

            if (($key = array_search($offer->id, $offersHistory)) !== false) {
                unset($offersHistory[$key]);
            }

        }

        array_push($offersHistory, $offer->id);

        if (count($offersHistory) > 10) {
            array_shift($offersHistory);
        }

        $request->session()->put('OFFERS_SEEN_HISTORY', $offersHistory);
    }

}
