<?php

namespace App\Models\Order;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @property integer $id
 * @property integer $cart_id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $home
 * @property string $floor
 * @property string $porch
 * @property string $time_delivery
 * @property string $date_delivery
 * @property string $organization
 * @property integer $pay_type
 * @property integer $user_id
 * @property double $total
 * @property string $comment
 * @property integer $status
 * @property integer $delivery_type
 * @property string $city
 * @property string $street
 * @property integer $house
 * @property integer $apartment
 * @property integer $entrance
 * @property integer $intercom
 * @property integer $building
 * @property double $delivery_cost
 *
 * @property-read User $user
 */
class Order extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'orders';
    protected $table = self::TABLE_NAME;

    const ATTR_ID            = 'id';
    const ATTR_CART_ID       = 'cart_id';
    const ATTR_NAME          = 'name';
    const ATTR_PHONE         = 'phone';
    const ATTR_ADDRESS       = 'address';
    const ATTR_HOME          = 'home';
    const ATTR_FLOOR         = 'floor';
    const ATTR_PORCH         = 'porch';
    const ATTR_TIME_DELIVERY = 'time_delivery';
    const ATTR_DATE_DELIVERY = 'date_delivery';
    const ATTR_ORGANIZATION  = 'organization';
    const ATTR_PAY_TYPE      = 'pay_type';
    const ATTR_USER_ID       = 'user_id';
    const ATTR_TOTAL         = 'total';
    const ATTR_COMMENT       = 'comment';
    const ATTR_STATUS        = 'status';
    const ATTR_DELIVERY_TYPE = 'delivery_type';
    const ATTR_CITY          = 'city';
    const ATTR_STREET        = 'street';
    const ATTR_HOUSE         = 'house';
    const ATTR_APARTMENT     = 'apartment';
    const ATTR_ENTRANCE      = 'entrance';
    const ATTR_INTERCOM      = 'intercom';
    const ATTR_BUILDING      = 'building';
    const ATTR_DELIVERY_COST = 'delivery_cost';

    const STATUS_NO_PAID = 0;
    const STATUS_PAID    = 1;


    const TYPE_CASH   = 0;
    const TYPE_ONLINE = 1;

    const DELIVERY_TYPE_PICKUP  = 1;
    const DELIVERY_TYPE_COURIER = 2;

    const WITH_USER = 'user';

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_CART_ID,
        self::ATTR_NAME,
        self::ATTR_USER_ID,
        self::ATTR_ADDRESS,
        self::ATTR_COMMENT,
        self::ATTR_DATE_DELIVERY,
        self::ATTR_FLOOR,
        self::ATTR_PHONE,
        self::ATTR_HOME,
        self::ATTR_PORCH,
        self::ATTR_TIME_DELIVERY,
        self::ATTR_ORGANIZATION,
        self::ATTR_PAY_TYPE,
        self::ATTR_TOTAL,
        self::ATTR_STATUS,
        self::ATTR_DELIVERY_TYPE,
        self::ATTR_CITY,
        self::ATTR_STREET,
        self::ATTR_HOUSE,
        self::ATTR_APARTMENT,
        self::ATTR_ENTRANCE,
        self::ATTR_INTERCOM,
        self::ATTR_BUILDING,
        self::ATTR_USER_ID,
        self::ATTR_DELIVERY_COST,
    ];

    protected $with = [self::WITH_USER];

    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }

    public static function getStatusesVariants()
    {
        return [
            static::STATUS_NO_PAID => 'Не оплачен',
            static::STATUS_PAID    => 'Оплачен',
        ];
    }


    public static function getTypesVariants()
    {
        return [
            static::TYPE_CASH   => 'Наличными',
            static::TYPE_ONLINE => 'Картой',
        ];
    }

    public static function getDeliveryVariants()
    {
        return [
            self::DELIVERY_TYPE_PICKUP  => 'Самовывоз',
            self::DELIVERY_TYPE_COURIER => 'Доставка курьером'
        ];
    }

    public function getFullAddressAttribute($value)
    {
        return implode(',', [$this->address]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
