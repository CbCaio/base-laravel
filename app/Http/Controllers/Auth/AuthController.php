<?php

namespace BaseLaravel\Http\Controllers\Auth;

use BaseLaravel\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use BaseLaravel\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /*
     * @username                    name of the input sent to attempt login
     * @usersTableEmailFieldName    name of the email field to be used to attempt login
     * @usersTableUsernameFieldName name of the username field to be used to attempt login
     * @loginPath                   path of login page
     * @redirectAfterLogout         path to be sent after logged out
     * @redirectPath                path to be send after successful registration/login
     */
    public $username                    = 'email';
    public $usersTableEmailFieldName    = 'email';
    public $usersTableUsernameFieldName = 'username';
    public $loginPath                   = '/auth/login';
    public $redirectAfterLogout         = '/auth/login';
    public $redirectPath                = '/';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255|letters_spaces',
            'username' => 'required|alpha_num|max:45|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => strtolower($data['username']),
            'email'    => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, $this->makeRules($request));
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())->withInput($request->only($this->loginUsername(), 'remember'))->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage(),
        ]);
    }

    /**
     * Make the proper rules for login attempt depending on loginType (username or email).
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function makeRules(Request $request)
    {
        $loginType = $this->identifyLoginType($request);
        if ($loginType == 'email')
            return [
                $this->loginUsername() => 'required|max:255|email|exists:users,email',
                'password'             => 'required|min:6',
            ]; else
            return [
                $this->loginUsername() => 'required|max:255|exists:users,username',
                'password'             => 'required|min:6',
            ];
    }

    /**
     * Identify the loginType (username or email)
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function identifyLoginType(Request $request)
    {
        return filter_var($request->get($this->loginUsername()), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \BaseLaravel\Models\User $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, User $user)
    {
        $login_datetime   = new DateTime();
        $user->last_login = $login_datetime->format('Y-m-d H:i:s');
        $user->save();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $loginType = $this->identifyLoginType($request);
        if ($loginType == 'email')
            return [
                $this->usersTableEmailFieldName => $request->get($this->loginUsername()),
                'password'                      => $request->get('password')
            ]; else
            return [
                $this->usersTableUsernameFieldName => $request->get($this->loginUsername()),
                'password'                         => $request->get('password')
            ];
    }


}
