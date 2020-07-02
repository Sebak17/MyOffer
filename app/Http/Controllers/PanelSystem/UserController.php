<?php

namespace App\Http\Controllers\PanelSystem;

use App\Http\Controllers\Controller;
use App\Rules\ValidFirstName;
use App\Rules\ValidPassword;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

        $ar = explode("/", $file->store('public/avatars'));
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



}
