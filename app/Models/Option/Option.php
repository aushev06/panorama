<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Option
 *
 * @property int $id
 * @property string $name
 * @property integer $price
 * @property int $status
 * @property int $option_category_id
 * @property int $multiplier
 *
 * @property-read OptionCategory $category
 * @package App\Models\Option
 */
class Option extends Model
{
    const ATTR_ID                 = "id";
    const ATTR_NAME               = "name";
    const ATTR_PRICE              = "price";
    const ATTR_STATUS             = "status";
    const ATTR_OPTION_CATEGORY_ID = "option_category_id";
    const ATTR_MULTIPLIER         = 'multiplier';

    const STATUS_ACTIVE           = 1;
    const STATUS_INACTIVE         = 0;

    const WITH_CATEGORY = 'category';

    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_STATUS,
        self::ATTR_OPTION_CATEGORY_ID,
        self::ATTR_PRICE,
        self::ATTR_MULTIPLIER
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(OptionCategory::class);
    }

    /**
     * @return array
     */
    public static function getStatusVariants()
    {
        return [
            static::STATUS_ACTIVE   => "Активно",
            static::STATUS_INACTIVE => "Выключено"
        ];
    }
}
