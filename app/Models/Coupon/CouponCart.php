<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CouponCart
 *
 * @property integer $id
 * @property integer $coupon_id
 * @property integer $cart_id
 */
class CouponCart extends Model
{
    const TABLE_NAME = 'coupon_cart';

    const ATTR_ID        = 'id';
    const ATTR_COUPON_ID = 'coupon_id';
    const ATTR_CART_ID   = 'cart_id';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_CART_ID,
        self::ATTR_COUPON_ID
    ];

}
