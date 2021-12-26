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
        $model->total   = $total ?? 0;

        $model->save();

        return $model;


    }

    /**
     * @param int $cartId
     * @param int $foodPropertyId
     * @param float $price
     * @param int $quantity
     * @param array $body
     * @return CartProperty
     *
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function setProperty(
        CartProperty $cartProperty,
        float $price,
        int $quantity
    ): CartProperty {


        $cartProperty->quantity += $quantity;
        $cartProperty->price    = $price;
        $cartProperty->save();

        // ==== обновление общей суммы корзины
        $this->updateTotal($cartProperty->cart_id);

        return $cartProperty;
    }

    public function updateTotal($cartID)
    {
        $total = 0;
        /**
         * @var Cart $cart
         */

        $cart = Cart::findOrFail($cartID);

        /**
         * @var CartProperty[] $cartProps
         */
        $cartProps = CartProperty::where(CartProperty::ATTR_CART_ID, $cartID)->get();

        foreach ($cartProps as $cartProp) {
            $total += $cartProp->price * $cartProp->quantity;

            $options = $cartProp->options()->get();

            foreach ($options as $option) {
                $total += ($option->pivot->quantity * $option->pivot->price) * $cartProp->quantity;
            }

        }
        $cart->total = $total;
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

        if (null === $cart) {
            $cart = $this->store($session, 0);
        }

        return $cart;
    }

    public function getPropertiesCart(int $cartID)
    {
        $props = CartProperty::query()
            ->with([CartProperty::WITH_OPTIONS])
            ->select([
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_ID . ' as cart_property_id',
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_ID . ' as id',
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_CART_ID . ' as cart_id',
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_QUANTITY,
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_PRICE,
                CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_FOOD_PROPERTY_ID,
                DB::raw(CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_PRICE . '*' . CartProperty::TABLE_NAME . '.' . CartProperty::ATTR_QUANTITY . ' as total_sum'),
                Food::TABLE_NAME . '.' . Food::ATTR_IMG . ' AS mainIMG',
                FoodProperty::TABLE_NAME . '.' . FoodProperty::ATTR_IMG,
                Food::TABLE_NAME . '.' . Food::ATTR_NAME . " as name",
                FoodProperty::TABLE_NAME . '.' . FoodProperty::ATTR_NAME . " as cart_property_name",
                Food::TABLE_NAME . '.' . Food::ATTR_MITM_ID,
                Food::TABLE_NAME . '.' . Food::ATTR_ID . ' as food_id',
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
        /**
         * @var CartProperty $model
         */
        $model = CartProperty::findOrFail($id);
        $model->fill($attributes);

        if (0 === $model->quantity) {
            $model->delete();
        } else {
            $model->save();
        }


        $this->updateTotal($model->cart_id);
    }


    /**
     * @param $cartId
     * @param $foodPropertyId
     * @return CartProperty
     *
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function getProperty($cartId, $foodPropertyId): CartProperty
    {
        /**
         * @var CartProperty $cartProperty
         */

        $cartProperty = $this->cartPropertyModel::where([
            [$this->cartPropertyModel::ATTR_CART_ID, $cartId],
            [$this->cartPropertyModel::ATTR_FOOD_PROPERTY_ID, $foodPropertyId],
        ])->orderByDesc('id')->first();

        if ($cartProperty) {
            return $cartProperty;
        }

        $cartProperty = new CartProperty();

        $cartProperty->cart_id          = $cartId;
        $cartProperty->food_property_id = $foodPropertyId;

        return $cartProperty;

    }
}
