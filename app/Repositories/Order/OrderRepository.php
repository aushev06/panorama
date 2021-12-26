<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 15.09.2019
 * Time: 17:38
 */

namespace App\Repositories\Order;


use App\Models\Cart\Cart;
use App\Models\Cart\CartProperty;
use App\Models\Food\Food;
use App\Models\Food\FoodProperty;
use App\Models\Order\Order;
use App\Repositories\Cart\CartRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function store(array $attributes = [])
    {
        $this->order->fill($attributes);
        $this->order->status =Order::STATUS_NO_PAID;

        $this->order->date_delivery = $this->order->date_delivery ?: date("Y-m-d");
        $this->order->time_delivery = $this->order->time_delivery ?: Carbon::now()->toTimeString();
        $this->order->save();

        return $this->order;
    }

    public function update(array $attributes, int $id)
    {
        $order = Order::findOrFail($id);
        $order->update($attributes);
        $order->save();

        return $order;
    }

    public function get()
    {
        $orders = $this->order;

        return $orders;
    }


    public function destroy($id)
    {
        $order = $this->order::findOrFail($id)->delete();

        return true;
    }

    public function getOrderProperties($cartID)
    {
        $cartRepository = new CartRepository(new Cart(), new CartProperty());
        return $cartRepository->getPropertiesCart($cartID);

    }
}
