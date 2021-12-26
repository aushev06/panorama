<?php

namespace App\Console\Commands;

use App\Models\Food\Food;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseIdFoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "[~] Запуск парсера \n\n";

        $token    = env('TILLYPAD_TOKEN');
        $client   = new Client([
            'http_errors' => false,
        ]);
        $response = $client->get('https://api.tillypad.online/_v1.0/Request.php', [
            'headers' => [
                'Authorization' => $token,
                'Content-Type'  => 'application/json',
                'Target'        => 'MenuItems',
            ],

        ]);

        if ($response->getStatusCode() == 200) {
            foreach (json_decode($response->getBody()->getContents()) as $item) {
                $name = $item->mitm_Name;
                $id   = $item->mitm_ID;

                try {
                    /**
                     * @var Food $food
                     */
                    $food = Food::where(Food::ATTR_NAME, 'LIKE', '%' . $name . '%')->orWhere(Food::ATTR_MITM_NAME, 'LIKE', '%' . $name . '%')->first();

                    if (null !== $food) {
                        echo "[~] Блюдо {$name} найдено \n\n";
                        $food->mitm_id = $id;
                        $food->save();
                    } else {
                        Log::info('Блюдо ' . $name . ' не найдено');
                    }

                } catch (\Throwable $exception) {
                    dd($exception);
                }

            }
        }

    }
}
