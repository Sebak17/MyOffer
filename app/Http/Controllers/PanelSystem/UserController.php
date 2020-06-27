<?php

namespace App\Http\Controllers\PanelSystem;

use App\Http\Controllers\Controller;
use App\Rules\ValidFirstName;
use App\Rules\ValidPassword;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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

        $response['success'] = true;
        return response()->json($response);
    }

}
