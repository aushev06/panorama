<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 02.09.2019
 * Time: 22:01
 */

namespace App\Http\Controllers\Admin;


use App\Dto\ClientStatistic;
use App\Dto\FoodStatistic;
use App\Models\Cart\CartProperty;
use App\Models\Food\Food;
use Illuminate\Support\Facades\DB;

class AdminController
{
    public function index()
    {
        $foodsStatistic = CartProperty::query()
            ->selectRaw('foods.name as name, SUM(cart_properties.quantity) as CNT')
            ->join('food_properties', 'food_properties.id', '=', 'cart_properties.food_property_id')
            ->join('foods', 'foods.id', '=', 'food_properties.food_id')
            ->groupBy('cart_properties.food_property_id')
            ->orderByDesc('CNT')
            ->get()
            ->toArray();

        $foods = [];
        foreach ($foodsStatistic as $item) {
            $foodItem        = new FoodStatistic();
            $foodItem->name  = $item['name'];
            $foodItem->count = $item['CNT'];
            $foods[]         = $foodItem;
        }

        $select = <<<SELECTQUERY
SELECT name, COUNT(id) as CNT
FROM orders
GROUP BY orders.phone
ORDER BY CNT DESC;
SELECTQUERY;

        $queryClients = DB::select($select);

        $clients = [];

        foreach ($queryClients as $client) {
            $item        = new ClientStatistic();
            $item->count = $client->CNT;
            $item->name  = $client->name;
            $clients[]   = $item;
        }

        return view('admin.index', [
            'foods'   => $foods,
            'clients' => $clients
        ]);
    }
}
