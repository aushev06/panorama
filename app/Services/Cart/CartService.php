<?php

declare(strict_types=1);

namespace App\Services\Cart;


use App\Http\Requests\Cart\CartRequest;
use App\Models\Cart\CartProperty;
use App\Models\Cart\CartPropertyOption;
use App\Models\Coupon\Coupon;
use App\Models\Food\FoodProperty;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Coupon\CouponRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * @var CartRepository
     */
    private $cartRepository;
    /**
     * @var CouponRepository
     */
    private $couponRepository;

    public function __construct(CartRepository $cartRepository, CouponRepository $couponRepository)
    {
        $this->cartRepository   = $cartRepository;
        $this->couponRepository = $couponRepository;
    }

    public function save(CartRequest $request): Cart
    {
        // Required data
        $session        = $request->get(Cart::SESSION_KEY) ?? $request->session()->get(Cart::SESSION_KEY);
        $foodPropertyId = $request->get('foodPropertyId');
        $foodProperty   = FoodProperty::findOrFail($foodPropertyId);
        $options        = Collection::make($request->post('options') ?? [])->keyBy('id')->sortBy('id');
        $optionIds      = $options->map(function ($item) {
            return $item['id'] . '_' . $item['quantity'];
        })->toArray();
        $options        = $options->toArray();


        $cart = Cart::where(Cart::ATTR_SESSION, $session)->first() ?? $this->cartRepository->store($session, 0);

        $cartProperty = $this->cartRepository->getProperty($cart->id, $foodProperty->id);
        // ===== Проверка на соответствие опций
        if (sizeof($options) !== 0) {
            $optionIds        = trim(implode(',', $optionIds));

//            $cartOptionsQuery = DB::select("SELECT cart_property_id, GROUP_CONCAT(cart_property_options.option_id, '_', cart_property_options.quantity) as `ids`
//FROM `cart_property_options`
//LEFT JOIN cart_properties  ON cart_property_options.cart_property_id = cart_properties.id
//WHERE cart_id = {$cart->id}
//GROUP BY cart_property_id
//HAVING  `ids` = '{$optionIds}'
//LIMIT 1");

            $cartOptionsQuery = CartPropertyOption::query()
                ->select(['cart_property_id', DB::raw("GROUP_CONCAT(cart_property_options.option_id, '_', cart_property_options.quantity) as ids")])
                ->join('cart_properties', 'cart_property_options.cart_property_id', '=', 'cart_properties.id')
                ->where('cart_id', $cart->id)
                ->groupBy(['cart_property_id'])
                ->having('ids', '=', $optionIds)
                ->limit(1)
                ->first();
            if (null === $cartOptionsQuery) {
                $cartProperty                   = new CartProperty();
                $cartProperty->cart_id          = $cart->id;
                $cartProperty->food_property_id = $foodPropertyId;
            } else {
                $cartProperty = CartProperty::findOrFail($cartOptionsQuery->cart_property_id);
            }


        }


        $cartProperty = $this->cartRepository->setProperty(
            $cartProperty,
            (float)$foodProperty->price,
            (int)$request->post('quantity')
        );

        // Добавление опций
        foreach ($request->post('options') ?? [] as $key => $option) {
            $optionCart = $cartProperty->options()->where(CartPropertyOption::ATTR_OPTION_ID,
                $key)->where(CartPropertyOption::ATTR_QUANTITY, $option['quantity'])->first();

            if (null === $optionCart) {
                $cartProperty->options()->attach($key, [
                    CartPropertyOption::ATTR_QUANTITY => $option['quantity'],
                    CartPropertyOption::ATTR_PRICE    => $option['price']
                ]);
            }

        }

        $this->cartRepository->updateTotal($cart->id);

        return $cart;
    }


    public function activateCoupon(Request $request)
    {


        /**
         * @var Coupon $coupon
         */
        $coupon = Coupon::where(Coupon::ATTR_COUPON, $request->post('coupon'))->firstOrFail();
        /**
         * @var Cart $cart
         */
        $cart = $this->cartRepository->getCart();

        if (false === $this->couponRepository->couponCheck($coupon)) {
            return [
                'message' => 'Данный купон уже недействителен !'
            ];
        }

        $cart->total = $coupon->type == $coupon::TYPE_PERCENT ? $cart->total - ($cart->total * $coupon->value / 100) : $cart->total - $coupon->value;

        $cart->save();
        $coupon->incrementNumberOfActiovations();
        $cart->assignCoupon($coupon->id);

        return [
            'message' => 'Купон применен!'
        ];


    }


    /**
     * @param array $from
     * @param array $to
     * @return bool
     *
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function checkOptions(array $from, array $to)
    {
        if (sizeof($from) !== sizeof($to)) {
            return false;
        }

        foreach ($from as $key => $item) {
            if (false === array_key_exists($key, $to)) {
                return false;
            }
        }

        return true;
    }
}
