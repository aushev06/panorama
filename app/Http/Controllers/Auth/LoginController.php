<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Smspilot\SmspilotService;
use App\Services\Twilio\TwilioService;
use App\User;
use http\Env\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    /**
     * @var TwilioService
     */
    private $phoneService;

//    public function __construct(TwilioService $twilio)
    public function __construct(SmspilotService $phoneService)
    {
        $this->middleware('guest')->except('logout');
        $this->phoneService = $phoneService;
    }


    public function login(Request $request)
    {
        $login    = $request->post('login');
        $password = $request->post('password');
        $field    = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $message  = '';

        if( config('app.SEND_PHONE_MESSAGE_OPERATION') === true ) {
            $user = User::where($field, '=', $login)->first();

            $wrongPassword = !password_verify($password, $user->password);

            if( !$wrongPassword && $user && !$user->hasVerifiedPhone() )
            {

                $message = 'Необходимо активировать номер телефона.';
                $message2 = '';

                $smsSent = false;
                if( $field === 'phone' && !$this->phoneService->hasAuthCodes($login) )
                {
                    $smsSent = $this->phoneService->sendRegistrationCodePhone($login);
                    $message2 = $smsSent ? 'На Ваш телефон отправлен код активации' : 'Сервис отправки смс кодов недоступен.';
                }

                return \response()->json(['errors' => [
                    'message' => $message,
                    'activatingPhone' => $message2
                ]], 401);
            }

            if($wrongPassword)
            {
                $message = 'Неверный логин или пароль!';
                return \response()->json(['errors' => [
                    'message' => $message,
                    'wrongPassword' => true
                ]], 422);
            }

        }

        if (Auth::attempt([$field => $login, User::ATTR_PASSWORD => $password],
            $request->post('remember') ? true : false)) {
            return \auth()->user()->role === User::ROLE_ADMIN ? redirect('/admin') : redirect('/cabinet');
        }

        return \response()->json(['errors' => [
            'message' => 'Неверный логин или пароль!',
            'wrongPassword' => true
        ]], 422);

    }
}
