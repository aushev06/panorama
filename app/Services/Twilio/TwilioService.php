<?php

namespace App\Services\Twilio;


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

class TwilioService extends PhoneService
{

    private $PHONE;

    /**
     * @var TwilioClient
     */
    private $twilioClient;

    public function __construct()
    {
        $setting = Cache::get('settings');
        $SID   = $setting[Setting::SETTING_TWILIO_SID]['value'] ?? env('TWILIO_ACCOUNT_SID');
        $TOKEN = $setting[Setting::SETTING_TWILIO_TOKEN]['value'] ?? env('TWILIO_AUTH_TOKEN');
        $this->PHONE = $setting[Setting::SETTING_TWILIO_PHONE]['value'] ?? env('TWILIO_MOBILE_NUMBER');

        $this->twilioClient = new \Twilio\Rest\Client($SID, $TOKEN);
    }

//    public function generateAndSaveCode($login, $count = 6) {
//        $min = 10**($count - 1);
//        $max = (10**$count) - 1;
//        $code = rand($min, $max);
//        DB::table('user_auth_codes')->insert(['login' => $login, 'code' => $code, 'created_at' => Carbon::now()]);
//        return $code;
//    }

    public function sendResetLinkPhone(User $user)
    {
        $userPhone = $user->phone;

        if( !DB::table('user_auth_codes')->where('login', '=', $userPhone)->first() ) {
            $code = $this->generateAndSaveCode($userPhone, 6);
            $message = 'magia-dostavka.ru. Код сброса пароля: ' . $code;
//            $message = 'Код сброса пароля magia-dostavka.ru: ' . $code;

            $phoneMessage = $this->twilioClient->messages
                ->create('+' . $userPhone, // to
                    [
                        "body" => $message,
                        "from" => $this->PHONE
                    ]
                );

            return \response()->json([
                'isCodeType' => 'new',
            ], 200);
        }

        return \response()->json([
            'isCodeType' => 'old',
        ], 200);

    }

//    public function hasAuthCodes(string $login) {
//        $codes = DB::table('user_auth_codes')->where(['login' => $login])->first();
//
//        if($codes) return true;
//        else return false;
//    }

    public function sendRegistrationCodePhone(string $userPhone)
    {
        $code = $this->generateAndSaveCode($userPhone, 4);
//        $message = 'Код активации учетной записи magia-dostavka.ru: ' . $code;
        $message = 'magia-dostavka.ru. Код активации аккаунта: ' . $code;

        $phoneMessage = $this->twilioClient->messages
            ->create('+' . $userPhone, // to
                [
                    "body" => $message,
                    "from" => $this->PHONE
                ]
            );
    }

//    public function sendToTelegram(User $user, array $properties)
//    {
//        $setting = Cache::get('settings');
//        $message = "Новый заказ на сайте. Ссылка на заказ - " . 'http://magia-dostavka.ru/order/' . $order['id'];
//        $chatId  = $setting[Setting::SETTING_TELEGRAM_CHAT_ID]['value'];
//        $botId   = $setting[Setting::SETTING_TELEGRAM_BOT_ID]['value'];
//        $client  = new Client([
//            'http_errors' => false
//        ]);
//        Log::info('tes', [$chatId, $botId]);
//        $response = $client->get('https://api.telegram.org/' . $botId . '/sendMessage?chat_id=' . $chatId . '&text=' . $message);
//
//    }
}
