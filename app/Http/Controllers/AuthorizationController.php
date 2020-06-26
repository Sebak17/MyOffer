<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Rules\ValidEmail;
use App\Rules\ValidPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthorizationController extends Controller
{

	use ThrottlesLogins;
    use AuthenticatesUsers;

    protected $maxAttempts  = 5;
    protected $decayMinutes = 1;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signIn(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email'  => new ValidEmail,
            'password'  => new ValidPassword,
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $response['msg'] = "Za dużo prób logowania! Poczekaj " . $this->limiter()->availableIn($this->throttleKey($request)) . " sekund!";
            return response()->json($response);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (auth()->user()->active == 0) {
                UserHelper::addToHistory(
                    auth()->user(),
                    "AUTH",
                    "Logowanie do konta... KONTO NIEAKTYWNE",
                );

                auth()->logout();

                $response['success'] = false;
                $response['msg']     = "Konto nie jest aktywowane!";
            } else {
                $response['success'] = true;

                UserHelper::addToHistory(
                    auth()->user(),
                    "AUTH",
                    "Logowanie do konta... SUKCES",
                );
            }

        } else {
            $this->incrementLoginAttempts($request);

            $response['success'] = false;
            $response['msg']     = "Dane logowania są niepoprawne!";
        }

		
        return response()->json($response);
    }

    public function signUp(Request $request)
    {
        $response = array();

        return response()->json($response);
    }
}
