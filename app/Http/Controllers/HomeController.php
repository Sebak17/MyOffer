<?php

namespace App\Http\Controllers;

use App\Helpers\OffersHelper;
use App\Helpers\CategoriesHelper;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function main(Request $request)
    {

        $categoriesMain = Category::where('active', 1)->where('visible', 1)->where('overcategory', 0)->orderBy('orderID', 'ASC')->get();

        $offersHistory = $request->session()->get('OFFERS_SEEN_HISTORY', []);

        $offersFromHistory = array();

        foreach ($offersHistory as $id) {

            $offer = Offer::where('id', $id)->first();

            if ($offer == null) {
                continue;
            }

            if ($offer->status != 'VISIBLE') {
                continue;
            }

            array_push($offersFromHistory, $offer);
        }

        $offersFromHistory = array_reverse($offersFromHistory);

        $offersLastAdded = Offer::where('status', 'VISIBLE')->orderBy('created_at', 'desc')->limit(10)->get();

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

            $categoryPath = OffersHelper::generateCategoryPathHTML($offer->category_id);

            return view('home.offers.item')->with('offer', $offer)->with('categoryPath', $categoryPath)->with('owner', true);
        } else {
            return view('home.offers.not_found');
        }

    }

    public function offers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'  => 'required|integer',
            'locd'       => 'required|integer',
            's'         => 'required|string',
            'sort'      => 'required|numeric',
            'price-min' => 'required|numeric',
            'price-max' => 'required|numeric',
            'page'      => 'required|integer',
        ]);

        $requestCategory = $request->input('category');
        $requestLocDistrict = $request->input('locd');
        $requestString = $request->input('s');
        $requestSort = $request->input('sort');

        $requestPriceMin = $request->input('price-min');
        $requestPriceMax = $request->input('price-max');

        $requestPage = $request->input('page');

        if ($validator->fails()) {

            if ($validator->errors()->first('category') != '') {
                $requestCategory = 0;
            }

            if ($validator->errors()->first('locd') != '') {
                $requestLocDistrict = 0;
            }

            if ($validator->errors()->first('s') != '') {
                $requestString = "";
            }

            if ($validator->errors()->first('sort') != '') {
                $requestSort = 0;
            }

            if ($validator->errors()->first('price-min') != '') {
                $requestPriceMin = -1;
            }

            if ($validator->errors()->first('price-max') != '') {
                $requestPriceMax = -1;
            }

            if ($validator->errors()->first('page') != '') {
                $requestPage = 1;
            }

        }

        $categoryCurrentInfo = [
            'id'   => 0,
            'name' => "Wszystkie kategorie",
        ];

        $categoryOverInfo = [];

        $categoriesSubList = Category::where('active', 1)->where('visible', 1)->where('overcategory', $requestCategory)->orderBy('orderID', 'ASC')->get();

        $categoriesAllSubList = CategoriesHelper::getAllSubCategories(Category::where('active', 1)->where('visible', 1)->get(), $requestCategory);

        if ($requestCategory != 0) {
            $categoryCurrent = Category::where('active', 1)->where('visible', 1)->where('id', $requestCategory)->first();

            if ($categoryCurrent != null) {
                $categoryCurrentInfo = [
                    'id'   => $categoryCurrent->id,
                    'name' => $categoryCurrent->name,
                ];

                if ($categoryCurrent->overcategory != 0) {

                    $categoryOver = Category::where('active', 1)->where('visible', 1)->where('id', $categoryCurrent->overcategory)->first();

                    if ($categoryOver != null) {
                        $categoryOverInfo = [
                            'id'   => $categoryOver->id,
                            'name' => $categoryOver->name,
                        ];
                    }

                } else {
                    $categoryOverInfo = [
                        'id'   => 0,
                        'name' => 'Wszystkich kategorii',
                    ];
                }

            }

        }

        $offers = array();

        foreach(Offer::where('status', 'VISIBLE')->get() as $offer) {

            if($requestCategory != 0 && ($offer->category_id != $requestCategory && !OffersHelper::isOfferInCategories($offer, $categoriesAllSubList)))
                continue;

            if($requestLocDistrict != 0 && $offer->loc_district != $requestLocDistrict)
                continue;

            if ($requestString != "" && !preg_match("/(" . $requestString . ")/i", $offer->title))
                continue;

            if ($requestPriceMin != -1 && $offer->price < $requestPriceMin) {
                continue;
            }

            if ($requestPriceMax != -1 && $offer->price > $requestPriceMax) {
                continue;
            }

            array_push($offers, $offer);
        }



        // SORT
        // 1 => nazwa od A do Z
        // 2 => nazwa od Z do A
        // 3 => od najnowszych
        // 4 => od najstarszych
        // 5 => cena rosnąco
        // 6 => cena malejąco

        switch ($requestSort) {
            case 1:
                usort($offers, function ($a, $b) {
                    return strcmp($a->title, $b->title);
                });
                break;
            case 2:
                usort($offers, function ($a, $b) {
                    return strcmp($b->title, $a->title);
                });
                break;
            case 3:
                usort($offers, function ($a, $b) {
                    if($a->created_at->equalTo($b->created_at))
                        return 0;

                    return $a->created_at->gt($b->created_at) ? -1 : 1;
                });
                break;
            case 4:
                usort($offers, function ($a, $b) {
                    if($a->created_at->equalTo($b->created_at))
                        return 0;

                    return $a->created_at->gt($b->created_at) ?  1 : -1;
                });
                break;
            case 5:
                usort($offers, function ($a, $b) {

                    if ($a->price == $b->price) {
                        return 0;
                    }

                    if ($a->price > $b->price) {
                        return 1;
                    }

                    return -1;
                });
                break;
            case 6:
                usort($offers, function ($a, $b) {

                    if ($a->price == $b->price) {
                        return 0;
                    }

                    if ($a->price < $b->price) {
                        return 1;
                    }

                    return -1;
                });
                break;
        }

        $offersPerPage = 10;

        $maxPage = ceil(count($offers) / $offersPerPage);
        $startResult = ($requestPage - 1) * $offersPerPage;

        $offers = array_slice($offers, $startResult, $offersPerPage);

        return view('home.offers.list')->with('offers', $offers)
                                       ->with('categoryCurrent', $categoryCurrentInfo)
                                       ->with('categoryOver', $categoryOverInfo)
                                       ->with('categoriesSubList', $categoriesSubList)
                                       ->with('pageCurrent', $requestPage)
                                       ->with('pageMax', $maxPage);
    }

}
