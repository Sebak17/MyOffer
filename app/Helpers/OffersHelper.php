<?php

namespace App\Helpers;

use App\Models\Category;
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

    public static function generateCategoryPathHTML($category_id)
    {
        $categoryPath   = "";
        $currCategoryID = $category_id;

        do {

            $category = Category::where('id', $currCategoryID)->first();

            $categoryPath = '<li class="breadcrumb-item"><a href="' . route('pageOffersList') . '?category=' . $currCategoryID . '">' . $category->name . '</a></li>' . $categoryPath;

            $currCategoryID = $category->overcategory;

        } while ($currCategoryID != 0);

        $categoryPath = '<li class="breadcrumb-item"><a href="' . route('pageOffersList') . '"><i class="fas fa-home"></i></a></li>' . $categoryPath;

        return $categoryPath;
    }

    public static function isOfferInCategories($offer, $categories)
    {
        foreach ($categories as $cat) {

            if ($cat->id == $offer->category_id) {
                return true;
            }

        }
        return false;
    }

}
