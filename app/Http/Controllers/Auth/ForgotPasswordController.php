<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Phone\PhoneService;
use App\Services\Smspilot\SmspilotService;
use App\Services\Twilio\TwilioService;
use App\User;
use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use mysql_xdevapi\Exception;
use Twilio\Rest\Client;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
//        $this->middleware(['guest', 'throttle:2, 1440']);
        $this->middleware('guest');
        $this->phoneService = $phoneService;
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required'],[
//            'email.required' => 'Email обязательно для заполнения',
            'email.required' => 'Необходимо указать номер телефона или Email-адрес',
        ]);
    }

    public function checkResetCode(Request $request) {
        $code = (string) $request->post('code');

        $login = DB::table('user_auth_codes')->select('login')
            ->where('code', '=', $code)->first();

//        if($login) DB::table('user_auth_codes')->where('login', '=', $login->login)->delete();
        if($login) {
            return \response()->json([
                'code' => $code
            ], 200);
        }
        return \response()->json(['errors' => [
            'message' => 'Неверный код восстановления!'
        ]], 422);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        if($request->email) {
            $user = User::query()->where('email', '=', $request->email)->first();
            if(!$user) return \response()->json([
                'errors' => ['Неверный Email-адрес.']
            ], 401);
        }

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function sendResetLinkPhone(Request $request) {

        if( config('app.SEND_PHONE_MESSAGE_OPERATION') === true ) {
            $phoneTo = $request->post('email');
            $user = User::query()->where('phone', '=', $phoneTo)->first();
            if($user) return $this->phoneService->sendResetLinkPhone($user);

            return \response()->json([
                'errors' => ['Неверный номер телефона']
            ], 401);
        } else {
            return \response()->json([
                'errors' => ['Восстановление пароля по номеру телефона на данный момент невозможна.', 'Введите свой email-адрес или оставьте сообщение на странице "Контакты"!']
            ], 401);
        }

    }

}
