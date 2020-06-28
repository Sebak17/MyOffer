<?php

namespace App\Http\Controllers;

use App\Helpers\OffersHelper;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function main(Request $request)
    {

        $categoriesMain = Category::where('active', 1)->where('visible', 1)->where('overcategory', 0)->orderBy('orderID', 'ASC')->get();

        $offersHistory = $request->session()->get('OFFERS_SEEN_HISTORY', []);

        $offersFromHistory = array();

        foreach ($offersHistory as $id) {

            $offer = Offer::where('id', $id)->first();

            if($offer == null)
                continue;

            if($offer->status != 'VISIBLE')
                continue;

            array_push($offersFromHistory, $offer);
        }

        $offersLastAdded = Offer::where('status', 'VISIBLE')->orderBy('created_at','desc')->limit(10)->get();

        return view('home.main')->with('categoriesMain', $categoriesMain)->with('offersHistory', $offersFromHistory)->with('offersLastAdded', $offersLastAdded);
    }

    public function offer(Request $request, $id, $name)
    {
        $offer = Offer::where('id', $id)->first();

        if ($offer == null) {
            return view('home.offers.not_found');
        }

        if ($name != $offer->generateURLName()) {
            return view('home.offers.not_found');
        }

        $haveAccess = false;
        $isOwner    = false;

        if (Auth::user()) {

            $user = Auth::user();

            if ($offer->user->id != $user->id) {

                if ($offer->status != 'VISIBLE') {
                    $haveAccess = false;
                } else {
                    $haveAccess = true;
                }

            } else {
                $haveAccess = true;
                $isOwner    = true;
            }

        } else {

            if ($offer->status != 'VISIBLE') {
                $haveAccess = false;
            } else {
                $haveAccess = true;
            }

        }

        if ($haveAccess) {

            OffersHelper::addOfferToHistory($request, $offer);

            return view('home.offers.item')->with('offer', $offer)->with('owner', true);
        } else {
            return view('home.offers.not_found');
        }

    }

    public function offers(Request $request)
    {

        
        return view('home.offers.list');
    }

}
