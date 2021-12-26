<?php

namespace App\Models\Cart;

use App\Models\Coupon\CouponCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property double $total
 * @property integer $user_id
 * @property string $session
 * @property integer $coupon_id
 * @property string $status
 */
class Cart extends Model
{
    use SoftDeletes;
    const SESSION_KEY = '_token';

    const ATTR_ID        = 'id';
    const ATTR_TOTAL     = 'total';
    const ATTR_USER_ID   = 'user_id';
    const ATTR_SESSION   = 'session';
    const ATTR_COUPON_ID = 'coupon_id';
    const ATTR_STATUS    = 'status';

    const TABLE_NAME = 'carts';

    protected $table = self::TABLE_NAME;

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    public function properties()
    {
        return $this->hasMany(CartProperty::class);
    }

    public function assignCoupon($couponID)
    {
        $checkExist = CouponCart::where([
            [CouponCart::ATTR_COUPON_ID, $couponID],
            [CouponCart::ATTR_CART_ID, $this->id]
        ])->first();

        if (null === $checkExist) {
            CouponCart::create([
                CouponCart::ATTR_COUPON_ID => $couponID,
                CouponCart::ATTR_CART_ID   => $this->id
            ]);

            return true;
        }

        return false;

    }

    public function unAssignCoupon()
    {
        CouponCart::where(CouponCart::ATTR_CART_ID, $this->id)->delete();
    }
}
