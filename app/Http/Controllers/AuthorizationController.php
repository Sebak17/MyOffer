<?php

namespace App\Http\Controllers;

use App\Rules\ValidEmail;
use App\Rules\ValidPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;

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
            $results['success'] = false;
            $results['msg']     = $validator->errors()->first();
            return response()->json($results);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $results['msg'] = "Za dużo prób logowania! Poczekaj " . $this->limiter()->availableIn($this->throttleKey($request)) . " sekund!";
            return response()->json($results);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        	$response['success'] = true;

        } else {
            $this->incrementLoginAttempts($request);

            $results['success'] = false;
            $results['msg']     = "Dane logowania są niepoprawne!";
        }

		
        return response()->json($response);
    }

    public function signUp(Request $request)
    {
        $response = array();

        return response()->json($response);
    }
}
