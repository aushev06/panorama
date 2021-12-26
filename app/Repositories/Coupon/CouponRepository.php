<?php

declare(strict_types=1);

namespace App\Repositories\Coupon;


use App\Models\Coupon\Coupon;

class CouponRepository
{
    /**
     * Функция проверяет активный ли купон и можно ли им пользоваться
     *
     * @param Coupon $coupon
     */
    public function couponCheck(Coupon $coupon): bool
    {

        if (time() > strtotime($coupon->expired_at) || $coupon->number_of_activations >= $coupon->quantity) {
            return false;
        }

        return true;

    }
}
