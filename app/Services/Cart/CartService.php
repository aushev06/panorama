<?php

declare(strict_types=1);

namespace App\Services\Cart;


use App\Http\Requests\Cart\CartRequest;
use App\Models\Coupon\Coupon;
use App\Models\Food\FoodProperty;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Coupon\CouponRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart\Cart;
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

        $cart = Cart::where(Cart::ATTR_SESSION, $session)->first();

        if (null == $cart) {
            $cart = $this->cartRepository->store($session, 0);
            $this->cartRepository->setProperty(
                $cart->id, $foodProperty->id,
                (float)$foodProperty->price,
                (int)$request->post('quantity')
            );
            return $cart;
        }


        $this->cartRepository->setProperty(
            $cart->id, $foodProperty->id,
            (float)$foodProperty->price,
            (int)$request->post('quantity')
        );

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
}
