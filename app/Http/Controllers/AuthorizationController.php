<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Helpers\Security;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPersonal;
use App\Models\UserSystem;
use App\Rules\ValidEmail;
use App\Rules\ValidFirstName;
use App\Rules\ValidPassword;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function pageSignUp(Request $request)
    {
        return view('home.auth.signup');
    }

    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => new ValidEmail,
            'password' => new ValidPassword,
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

        $validator = Validator::make($request->all(), [
            'user_email'     => new ValidEmail,
            'user_password'  => new ValidFirstname,
            'user_firstname' => new ValidFirstName,
            'user_phone'     => new ValidPhoneNumber,
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['success'] = false;
            $response['msg']     = $validator->errors()->first();
            return response()->json($response);
        }

        if (User::where('email', '=', $request->user_email)->exists()) {
            $response['success'] = false;

            $response['msg'] = "Taki email już jest zarejestrowany!";
            return response()->json($response);
        }

        $hashActivation = Security::generateChecksum(time(), rand(0, 99999), $request->user_email, $request->user_password, $request->user_firstname, $request->user_phone, Security::generatePassword(24));

        $user = User::create([
            'email'    => $request->user_email,
            'password' => bcrypt($request->user_password),
        ]);

        UserPersonal::create([
            'user_id'     => $user->id,
            'firstname'   => $request->user_firstname,
            'phoneNumber' => $request->user_phone,
        ]);

        UserSystem::create([
            'user_id' => $user->id,
            'firstIP' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',
            'activationHash' => $hashActivation,
        ]);

        UserHelper::addToHistory(
            $user,
            "AUTH",
            "Stworzono konto",
        );

        $response['success'] = true;
        return response()->json($response);
    }

}
