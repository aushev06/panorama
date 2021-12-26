<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
 * @property integer $id
 * @property string $coupon
 * @property integer $value
 * @property integer $type
 * @property integer $quantity
 * @property integer $status
 * @property integer $number_of_activations
 * @property $expired_at
 */
class Coupon extends Model
{
    use SoftDeletes;

    const ATTR_ID                    = 'id';
    const ATTR_COUPON                = 'coupon';
    const ATTR_VALUE                 = 'value';
    const ATTR_TYPE                  = 'type';
    const ATTR_QUANTITY              = 'quantity';
    const ATTR_STATUS                = 'status';
    const ATTR_NUMBER_OF_ACTIVATIONS = 'number_of_activations';
    const ATTR_EXPIRED_AT            = 'expired_at';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;


    const TYPE_PERCENT = 0;
    const TYPE_VALUE   = 1;

    protected $attributes = [
        self::ATTR_COUPON => '',
    ];

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_COUPON,
        self::ATTR_VALUE,
        self::ATTR_TYPE,
        self::ATTR_QUANTITY,
        self::ATTR_STATUS,
        self::ATTR_NUMBER_OF_ACTIVATIONS,
        self::ATTR_EXPIRED_AT,
    ];

    public static function getStatusesVariants()
    {
        return [
            static::STATUS_INACTIVE => 'Не активен',
            static::STATUS_ACTIVE   => 'Активен',
        ];
    }


    public static function getTypesVariants()
    {
        return [
            static::TYPE_PERCENT => 'Процент от суммы',
            static::TYPE_VALUE   => 'Значение от суммы',
        ];
    }


    public function incrementNumberOfActiovations()
    {
        $this->number_of_activations += 1;
        $this->save();
    }


}
