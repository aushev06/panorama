<?php

namespace App\Services\Smspilot;


use App\Models\Setting;
use App\Services\Phone\AuthSmsInterface;
use App\Services\Phone\PhoneService;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SmspilotService extends PhoneService
{

    /**
     * @var client
     */
    private $client;
    private $sender; //имя отправителя из списка https://smspilot.ru/my-sender.php
    private $apiKey; // API ключ
    private $phone; // номер телефона в международном формате

    public function __construct()
    {
        $setting      = Cache::get('settings');
        $this->phone  = $setting[Setting::SETTING_SMSPILOT_PHONE]['value'] ?? env('SMSPILOT_PHONE');
        $this->apiKey = $setting[Setting::SETTING_SMSPILOT_APIKEY]['value'] ?? env('SMSPILOT_APIKEY');

//        $this->apiKey = 'X55OVX419YZS40U6966B8B5I2R6P6832302O9I9786A2WTMG2DUI8YC2WAH934OP';
//        $this->phone = '79533984570';
        //Дефолтное INFORM, если нужно будет сменить - нужно почитать доку. Смена вроде для бизнес-акк
        $this->sender = 'INFORM';
    }



    public function sendResetLinkPhone(User $user)
    {
        $userPhone = $user->phone;
        $user = User::query()->where('phone', '=', $userPhone)->select(User::ATTR_PHONE_VERIFY_AT)->first();
        $verified = $user->phone_verified_at ? true : false;
        $codes = DB::table('user_auth_codes')->where('login', '=', $userPhone)->get();
        $isEmpty = true;
        foreach ($codes as $code) {
            if( strlen($code->code) === 6 ) {
                $isEmpty = false;
                break;
            }
        }

        if( $verified )
        {
            if( $isEmpty )
            {
                $code = $this->generateAndSaveCode($userPhone, 6);
                $message = 'magia-dostavka.ru. Код сброса пароля: ' . $code;
                $url = 'https://smspilot.ru/api.php'
                    .'?send='.urlencode( $message )
                    .'&to='.urlencode( $userPhone )
                    .'&from='. $this->sender
                    .'&apikey='. $this->apiKey
                    .'&format=json';

                $json = file_get_contents( $url );

                $response = json_decode( $json );
                if ( isset($response->error))
                {
                    return \response()->json([
                        'errors' => ['Сервис отпавки смс недоступен.'],
                    ], 401);
                }
            }

            return \response()->json([
                'isCodeType' => $isEmpty ? 'new' : 'old',
            ], 200);

        }

        return \response()->json([
            'isCodeType' => 'needVerify'
        ], 200);
    }

    public function sendRegistrationCodePhone(string $userPhone)
    {
//        $code = $this->generateAndSaveCode($userPhone, 4);
        $code = $this->generateCode(4);
//        $message = 'Код активации учетной записи magia-dostavka.ru: ' . $code;
        $message = 'magia-dostavka.ru. Код активации аккаунта: ' . $code;

        $url = 'https://smspilot.ru/api.php'
            .'?send='.urlencode( $message )
            .'&to='.urlencode( $userPhone )
            .'&from='. $this->sender
            .'&apikey='. $this->apiKey
            .'&format=json';

        $json = file_get_contents( $url );

        $response = json_decode( $json );
        if ( isset($response->error)) {
            return false;
        }

        $this->saveGeneratedCode($userPhone, $code);

        return true;
//        if ( !isset($response->error)) {
//            echo 'SMS успешно отправлена server_id='.$response->send[0]->server_id;
//        } else {
//            trigger_error( $response->description_ru, E_USER_WARNING );
//        }
    }

}
