<?php

namespace App\Http\Controllers\PanelSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferImage;
use App\Rules\ValidOfferCategory;
use App\Rules\ValidOfferDescription;
use App\Rules\ValidOfferImagesList;
use App\Rules\ValidOfferLocation;
use App\Rules\ValidOfferPrice;
use App\Rules\ValidOfferTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
    public function offerImageUpload(Request $request)
    {
        $response = array();

        if (!$request->hasFile('images')) {
            $response['success'] = false;
            return response()->json($response);
        }

        $validator = Validator::make($request->all(), [
            'images'   => 'required',
            'images.*' => 'mimes:png,jpeg|max:5000',
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $files = $request->file('images');

        $user = Auth::user();

        $images = array();

        foreach ($files as $file) {
            $ar   = explode("/", $file->store('public/tmp_images'));
            $hash = end($ar);

            OfferImage::create([
                'user_id' => $user->id,
                'name'    => $hash,
            ]);

            array_push($images, $hash);
        }

        $response['success'] = true;
        $response['images']  = $images;

        return response()->json($response);
    }

    public function offerImageRemove(Request $request)
    {
        $response = array();

        $validator = Validator::make($request->all(), [
            'hash' => 'required|string',
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $user = Auth::user();

        $offerImage = OfferImage::where('user_id', $user->id)->where('name', $request->get('hash'))->whereNull('offer_id')->first();

        if ($offerImage == null) {
            $response['success'] = false;

            return response()->json($response);
        }

        $offerImage->forceDelete();

        if (Storage::exists("public/tmp_images/" . $request->hash)) {
            Storage::delete("public/tmp_images/" . $request->hash);
        }

        $response['success'] = true;

        return response()->json($response);
    }

    public function addOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_title'       => new ValidOfferTitle,
            'offer_description' => new ValidOfferDescription,
            'offer_price'       => new ValidOfferPrice,
            'offer_location'    => new ValidOfferLocation,
            'offer_category'    => new ValidOfferCategory,
            'offer_images'      => new ValidOfferImagesList,
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $category = Category::where('id', $request->get('offer_category'))->first();

        if ($category == null) {
            $response['success'] = false;
            $response['msg']     = "Podana kategoria nie istnieje!";
            return response()->json($response);
        }

        $user = Auth::user();

        $offer = Offer::create([
            'user_id'     => $user->id,
            'status'      => 'VERIFICATION',
            'title'       => $request->get('offer_title'),
            'description' => $request->get('offer_description'),
            'price'       => $request->get('offer_price'),
            'location'    => $request->get('offer_location'),
            'category_id' => $category->id,
        ]);

        foreach ($request->get('offer_images') as $imgHash) {
            $offerImage = OfferImage::where('user_id', $user->id)->where('name', $imgHash)->whereNull('offer_id')->first();

            if ($offerImage == null) {
                continue;
            }

            $offerImage->offer_id = $offer->id;
            $offerImage->save();

            Storage::move("public/tmp_images/" . $imgHash, "public/offers_images/" . $imgHash);
        }


        foreach (OfferImage::where('user_id', $user->id)->whereNull('offer_id')->get() as $image) {
            
            $image->forceDelete();

            if (Storage::exists("public/tmp_images/" . $image->name)) {
                Storage::delete("public/tmp_images/" . $image->name);
            }
        }

        $response['success'] = true;
        return response()->json($response);
    }

}
