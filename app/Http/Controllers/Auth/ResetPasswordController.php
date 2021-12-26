<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use http\Exception\RuntimeException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use mysql_xdevapi\Exception;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    protected function validationErrorMessages()
    {
        return [
            'password.min' => 'Пароль должен состоять минимум из 8 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }

    public function getResetToken(Request $request, $token = null, $id = null) {
        $user = $id ? $user = User::query()->where('id', '=', $id)->first() : null;

        return \response()->json([
            'token' => $token,
            'email' => $user->email ?? $id
        ], 200);
    }

    public function resetPhone(Request $request) {
        $request->validate($this->rulesPhone(), $this->validationErrorMessages());

        $code = $request->token;
        $newPassword = $request->password;

        $login = DB::table('user_auth_codes')->where('code', '=', $code)->select('login')->first();
        if(!$login) return false;

        $user = User::where('phone', '=', $login->login)->first();
        $user->password = Hash::make($newPassword);
        if( $user->save() ) {
            DB::table('user_auth_codes')->where('login', '=', $user->phone)->delete();
            event(new PasswordReset($user));
            $this->guard()->login($user);

            return 'success';
        }

        return 'error';
    }

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        if($request->email) {
            $token = DB::table('password_resets')->where('email', '=', $request->email)->first();
            $validToken = Hash::check($request->token, $token->token);

            if(!$validToken) return \response()->json([
                'errors' => ['email' => ['Произошла ошибка']]
            ], 400);
        }

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET ? 'success' : 'error';
    }

    protected function rulesPhone()
    {
        return [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
