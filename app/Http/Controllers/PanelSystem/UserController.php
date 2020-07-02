<?php

namespace App\Http\Controllers\PanelSystem;

use App\Models\Offer;
use App\Http\Controllers\Controller;
use App\Rules\ValidFirstName;
use App\Rules\ValidID;
use App\Rules\ValidPassword;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function changeAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:png,jpeg|max:5000',
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $user = Auth::user();

        if ($user->avatar != null && Storage::exists("public/avatars/" . $user->avatar)) {
            Storage::delete("public/avatars/" . $user->avatar);
        }

        $file = $request->file('image');

        $ar   = explode("/", $file->store('public/avatars'));
        $hash = end($ar);

        $user->avatar = $hash;
        $user->save();

        $response['success'] = true;
        return response()->json($response);
    }

    public function changePersonal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_firstname' => new ValidFirstName,
            'user_phone'     => new ValidPhoneNumber,
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $user = Auth::user();

        // TODO

        $response['success'] = true;
        return response()->json($response);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_password_old' => new ValidPassword,
            'user_password_new' => new ValidPassword,
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $user = Auth::user();

        // TODO

        $response['success'] = true;
        return response()->json($response);
    }

    public function changeFavoriteStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => new ValidID,
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        $offer = Offer::where('id', $request->id)->where('status', 'VISIBLE')->first();

        if ($offer == null) {
            $response['success'] = false;
            return response()->json($response);
        }

        $user = Auth::user();

        $favs = json_decode($user->getFavorites()->offers, true);

        if (!in_array($request->id, $favs)) {

            array_push($favs, $request->id);
            $user->getFavorites()->offers = json_encode($favs);
            $user->push();

            $response['success'] = true;
            $response['status']  = true;
            return response()->json($response);
        }

        if (($key = array_search($request->id, $favs)) !== false) {
            unset($favs[$key]);
        }

        $favs = array_values($favs);

        $user->getFavorites()->offers = json_encode($favs);
        $user->push();

        $response['success'] = true;
        $response['status']  = false;
        return response()->json($response);
    }

}
