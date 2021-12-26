<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $login    = $request->post('login');
        $password = $request->post('password');
        $field    = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';


        if (Auth::attempt([$field => $login, User::ATTR_PASSWORD => $password],
            $request->post('remember') ? true : false)) {
            return redirect('/admin');
        }


        return view('auth.login')->withErrors([
            'message' => 'Неверный логин или пароль!'
        ]);

    }
}
