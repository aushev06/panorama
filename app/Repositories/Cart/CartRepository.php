<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\Cart\Cart;
use App\Models\Cart\CartProperty;
use App\Models\Food\Food;
use App\Models\Food\FoodProperty;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartRepository
{
    /**
     * @var Cart
     */
    private $cartModel;
    /**
     * @var CartProperty
     */
    private $cartPropertyModel;

    public function __construct(Cart $cartModel, CartProperty $cartPropertyModel)
    {
        $this->cartModel         = $cartModel;
        $this->cartPropertyModel = $cartPropertyModel;
    }

    /**
     * @param array $attributes
     * @return Cart
     */
    public function store(string $session, float $total, ?string $user_id = null): Cart
    {
        /**
         * @var Cart $model
         */
        $model          = new $this->cartModel;
        $model->session = $session;
        $model->user_id = $user_id;
        $model->total   = $total;

        $model->save();

        return $model;


    }

    public function setProperty(int $cartId, int $foodPropertyId, float $price, int $quantity): CartProperty
    {
        /**
         * @var CartProperty $cartProperty
         */
        $cartProperty = $this->cartPropertyModel::where([
            [$this->cartPropertyModel::ATTR_CART_ID, $cartId],
            [$this->cartPropertyModel::ATTR_FOOD_PROPERTY_ID, $foodPropertyId],
        ])->first();

        if (null !== $cartProperty) {
            $cartProperty->quantity += $quantity;
            $cartProperty->price    = $price;
            $cartProperty->save();
            $this->updateTotal($cartId);

            return $cartProperty;

        }

        $cartProperty                   = new $this->cartPropertyModel;
        $cartProperty->cart_id          = $cartId;
        $cartProperty->food_property_id = $foodPropertyId;
        $cartProperty->quantity         = $quantity;
        $cartProperty->price            = $price;

        $cartProperty->save();


        // ==== обновление общей суммы корзины
        $this->updateTotal($cartId);

        return $cartProperty;
    }

    private function updateTotal($cartID)
    {
        $total = 0;
        /**
         * @var Cart $cart
         */

        $cart = Cart::findOrFail($cartID);

        $cartProps = CartProperty::where(CartProperty::ATTR_CART_ID, $cartID)->get()->toArray();

        foreach ($cartProps as $cartProp) {
            $total += $cartProp['price'] * $cartProp['quantity'];
        }
        $cart->total = round($total, 2);
        $cart->save();

    }

    public function bySession(string $session)
    {
        return;
    }

    public function getCart()
    {
        $session = request(Cart::SESSION_KEY) ?? Session::get(Cart::SESSION_KEY);

        $cart = Cart::where([
            [Cart::ATTR_SESSION, $session],
            [Cart::ATTR_STATUS, Cart::STATUS_ACTIVE]
        ])->first();

        return $cart;
    }

    public function getPropertiesCart(int $cartID)
    {
        $props = CartProperty::select([
            CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_ID . ' as cart_property_id',
            CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_CART_ID . ' as cart_id',
            CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_QUANTITY,
            CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_PRICE,
            DB::raw(CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_PRICE . '*' . CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_QUANTITY . ' as total_sum'),
            Food::TABLE_NAME . '.' . Food::ATTR_IMG,
            Food::TABLE_NAME . '.' . Food::ATTR_NAME,
            Food::TABLE_NAME . '.' . Food::ATTR_MITM_ID,
        ])
            ->join(FoodProperty::TABLE_NAME, FoodProperty::TABLE_NAME . '.' . FoodProperty::ATTR_ID, '=',
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_FOOD_PROPERTY_ID)
            ->join(Food::TABLE_NAME, Food::TABLE_NAME . '.' . Food::ATTR_ID, '=',
                FoodProperty::TABLE_NAME . '.' . FoodProperty::ATTR_FOOD_ID)
            ->join(Cart::TABLE_NAME, Cart::TABLE_NAME . '.' . Cart::ATTR_ID, '=',
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_CART_ID)
            ->where(CartProperty::ATTR_CART_ID, $cartID)
            ->get();

        return $props;
    }

    public function destroy($id)
    {
        CartProperty::where(CartProperty::ATTR_CART_ID, $id)->delete();
        /**
         * @var Cart $cart
         */
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return $cart;
    }

    public function destroyProperty($propertyId)
    {
        $cartProperty = CartProperty::findOrFail($propertyId);
        $cart         = $cartProperty->cart;
        $cartProperty->delete();

        $this->updateTotal($cart->id);

        if (0 === $this->getPropertiesCart($cart->id)->count()) {
            $this->destroy($cart->id);
        }

    }

    public function updateProperty($id, array $attributes = [])
    {
        $model = CartProperty::findOrFail($id);
        $model->fill($attributes);
        $model->save();

        $this->updateTotal($model->cart_id);
    }
}
