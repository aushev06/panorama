<?php

namespace App\Models\Promotions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Promotions
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property integer $status
 * @property string $discount
 * @property $expired_at
 * @method static findOrFail(int $id)
 */

class Promotions extends Model
{
    use SoftDeletes;

    const ATTR_ID          = 'id';
    const ATTR_NAME        = 'name';
    const ATTR_INFO        = 'info';
    const ATTR_STATUS      = 'status';
    const ATTR_DISCOUNT    = 'discount';
    const ATTR_EXPIRED_AT  = 'expired_at';
    const ATTR_CREATED_AT  = 'created_at';
    const ATTR_UPDATED_AT  = 'updated_at';
    const ATTR_DELETED_AT  = 'deleted_at';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    const TABLE_NAME = "promotions";
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_INFO,
        self::ATTR_STATUS,
        self::ATTR_DISCOUNT
    ];

    protected $hidden = [
        self::ATTR_EXPIRED_AT,
        self::ATTR_CREATED_AT,
        self::ATTR_UPDATED_AT,
        self::ATTR_DELETED_AT,
    ];

    public static function getStatusesVariants()
    {
        return [
            static::STATUS_INACTIVE => 'Не активен',
            static::STATUS_ACTIVE   => 'Активен',
        ];
    }

}
