<?php

namespace App\Http\Controllers\PanelSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{

    public function categoriesList(Request $request)
    {
        $response = array();

        $response['categories'] = array();

        $categories = Category::where('active', 1)->where('visible', 1)->get();

        foreach ($categories as $category) {
        	$cat = array();

        	$cat['id'] = $category->id;
        	$cat['name'] = $category->name;
        	$cat['icon'] = $category->icon;
        	
        	$cat['overcategory'] = $category->overcategory;
        	$cat['orderID'] = $category->orderID;

        	array_push($response['categories'], $cat);
        }

        $response['success'] = true;
        return response()->json($response);
    }
}
