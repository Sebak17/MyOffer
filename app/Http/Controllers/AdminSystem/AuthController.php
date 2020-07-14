<?php

namespace App\Http\Controllers\AdminSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidLogin;
use App\Rules\ValidPassword;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    protected $guard = 'admin';

	use AuthenticatesUsers;
	use ThrottlesLogins;

    protected $maxAttempts  = 3;
    protected $decayMinutes = 1;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function signIn(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'login'    => new ValidLogin,
            'password' => new ValidPassword,
            'remember_me' => 'required|boolean',
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

        if (Auth::guard('admin')->attempt(['login' => $request->login, 'password' => $request->password], $request->remember_me)) {
            $response['success'] = true;
            $response['url'] = route('pageAdminDashboard');
        } else {
            $this->incrementLoginAttempts($request);

            $response['success'] = false;
            $response['msg']     = "Dane logowania są niepoprawne!";
        }

        return response()->json($response);
    } 

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect()->route('pageAdminSignIn');
    }
}
