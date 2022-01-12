<?php

namespace App\Services\Telegram;


use App\Models\Order\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    public function sendToTelegram(Order $order)
    {
        $message = 'Новый заказ на сайте. ' . $order->status  ? 'Заказ оплачен' : 'Заказ не оплачен' . ' Ссылка на заказ - http://dostavka-panorama.ru/order-telegram/' . $order->id;
        $botId = 'bot972483178:AAEZccqLHo5Ce2f9bOSCNUkhFB17t_uI5hs';
        $chatId = '-500352969';
        $client = new Client(
            [
                'http_errors' => false
            ]
        );
//        Log::info('tes', [$chatId, $botId]);
        $response = $client->get(
            'https://api.telegram.org/' . $botId . '/sendMessage?chat_id=' . $chatId . '&text=' . $message
        );

//        $client  = new Client([
//            'http_errors' => false
//        ]);
//
//        $response = $client->post('http://limitless-journey-95386.herokuapp.com/public/jroo/?text=' . "https://dostavka-jroo.com/order-telegram/" . $order->id);

    }
}
