<?php

namespace App\Services\Telegram;


use App\Models\Order\Order;
use App\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    public function sendToTelegram(Order $order, array $properties)
    {
        $setting = Cache::get('settings');
        $message = "Новый заказ на сайте. Ссылка на заказ - " . 'http://ingvine-food.ru/order/' . $order['id'];
        $chatId  = $setting[Setting::SETTING_TELEGRAM_CHAT_ID]['value'];
        $botId   = $setting[Setting::SETTING_TELEGRAM_BOT_ID]['value'];
        $client  = new Client([
            'http_errors' => false
        ]);
        Log::info('tes', [$chatId, $botId]);
        $response = $client->get('https://api.telegram.org/' . $botId . '/sendMessage?chat_id=' . $chatId . '&text=' . $message);

    }
}
