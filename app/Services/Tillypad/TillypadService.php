<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 26.09.2019
 * Time: 22:00
 */

namespace App\Services\Tillypad;


use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Repositories\Cart\CartRepository;
use App\Services\Telegram\TelegramService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TillypadService
{


    /**
     * @param Order $order
     * @return mixed|null
     */
    public function getClient(Order $order)
    {
        $client = $this->checkClient($order->phone);

        if (null === $client) {
            $client = $this->saveClient($order->phone, '', $order->name, '', '', null, null);
            return $client;
        }

        return $client;

    }


    public function checkClient($phone)
    {
        $client = new Client([
            'http_errors' => false
        ]);

        $response = $client->get("https://api.tillypad.online/_v1.0/Request.php", [
            'headers' => [
                'Authorization' => env('TILLYPAD_TOKEN'),
                'Content-Type'  => 'application/json',
                'Target'        => 'Clients',
            ],

            'body' => json_encode(['pepl_PhoneCell' => $phone])
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }

        return null;
    }

    /**
     * @param string $phone
     * @param string|null $email
     * @param string|null $name
     * @param string|null $first_name
     * @param string|null $patronymic
     * @param string|null $birthday
     * @param int|null $idnt_code
     * @return mixed|null
     */
    public function saveClient(
        string $phone,
        ?string $email = '',
        ?string $name = '',
        ?string $first_name = '',
        ?string $patronymic = '',
        ?string $birthday = null,
        ?int $idnt_code = null
    ) {
        $arr = [
            "pepl_PhoneCell"    => $phone,
            "pepl_EMail"        => $email,
            "pepl_SecondName"   => $name,
            "pepl_FirstName"    => $first_name,
            "pepl_Patronymic"   => $patronymic,
            "pepl_DateBirthday" => $birthday,
            "idnt_Code"         => $idnt_code
        ];


        $response = $this->getGuzzle()->post("https://api.tillypad.online/_v1.0/Request.php", [
            'headers' => [
                'Target' => 'Clients',
            ],

            'body' => json_encode($arr)
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
        return null;
    }

    /**
     * @return Client
     */
    public function getGuzzle()
    {
        $client = new Client([
            'http_error' => false,
            'headers'    => [
                'Authorization' => env('TILLYPAD_TOKEN'),
                'Content-Type'  => 'application/json',
            ]
        ]);

        return $client;
    }


    public function sendingOrderToTillypad(Order $order, array $properties = [])
    {
        if (true === env('SEND_TILLYPAD', false)) {
            Log::info("Здесь");
            $json = [];

            $orderClient = $this->getClient($order);

            foreach ($properties as $key => $property) {
                $json[] = [
                    "orit_ID"       => "",
                    "clnt_id"       => $orderClient[0]['clnt_ID'],
                    "mitm_ID"       => $property['mitm_id'],
                    "mitm_value"    => "1",
                    "mitm_count"    => $property['quantity'],
                    "delivery_type" => $order->delivery_type,
                    "gest_Phone"    => $order->phone,
                    "City"          => $order->city,
                    "Street"        => $order->street,
                    "House"         => $order->house,
                    "Building"      => $order->building,
                    "Apartment"     => $order->apartment,
                    "Entrance"      => $order->entrance,
                    "Floor"         => $order->floor,
                    "Intercom"      => $order->intercom,
                    "Comment"       => "Test",
                    "gest_comment"  => $order::STATUS_PAID === $order->status ? 'Счёт оплачен' : 'Оплата наличными',
                    "RegionCode"    => "1",
                    "PostCode"      => "1"
                ];
            }
            try {
                $client = new Client();

                $response = $client->post('https://api.tillypad.online/_v1.0/Request.php', [
                    'headers' => [
                        'Authorization' => env('TILLYPAD_TOKEN'),
                        'Content-Type'  => 'application/json',
                        'Target'        => 'Delivery',
                    ],

                    'body' => json_encode($json),
                ]);

                $json = json_decode($response->getBody()->getContents(), true);

                if (true === isset($json[0]['ErrorNumber'])) {
                    throw new \Exception("Ошибка");
                }
                Log::info('Информация о заказе', [$response->getBody()->getContents()]);
                Log::info("Массив", $json);

            } catch (\Exception $exception) {
                Log::info('Информация о заказе', [$response->getBody()->getContents()]);
                Log::info("Массив", $json);
                (new TelegramService)->sendToTelegram($order);
            }


        }
    }
}
