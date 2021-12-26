<?php

namespace App\Models\PromotionCards;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PromotionCards
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $url
 * @property integer $status
 * @property integer $position
 * @property $expired_at
 * @method static findOrFail(int $id)
 */

class PromotionCards extends Model
{
    const ATTR_ID          = 'id';
    const ATTR_NAME        = 'name';
    const ATTR_IMG         = 'img';
    const ATTR_URL         = 'url';
    const ATTR_STATUS      = 'status';
    const ATTR_POSITION    = 'position';
    const ATTR_EXPIRED_AT  = 'expired_at';
    const ATTR_CREATED_AT  = 'created_at';
    const ATTR_UPDATED_AT  = 'updated_at';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    const TABLE_NAME = "promotion_cards";
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_IMG,
        self::ATTR_URL,
        self::ATTR_STATUS,
        self::ATTR_POSITION
    ];

    protected $hidden = [
        self::ATTR_EXPIRED_AT,
        self::ATTR_CREATED_AT,
        self::ATTR_UPDATED_AT,
    ];

    public static function getStatusesVariants()
    {
        return [
            static::STATUS_INACTIVE => 'Не активен',
            static::STATUS_ACTIVE   => 'Активен',
        ];
    }

    public function getImgAttribute($value)
    {
        return !$value ? asset('admin_assets/img/no_image.png') : url('storage/' . $value);
    }

}
