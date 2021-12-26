<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OptionCategory
 * @property integer $id
 * @property string $name
 * @property integer $max_count
 * @property integer $status
 * @property  integer $min_selected
 * @property integer $max_selected
 * @property  integer $required
 *
 * @property-read Option[] $options
 */
class OptionCategory extends Model
{
    const     ATTR_ID           = 'id';
    const     ATTR_NAME         = 'name';
    const     ATTR_MAX_COUNT    = 'max_count';
    const     ATTR_STATUS       = 'status';
    const     ATTR_MIN_SELECTED = 'min_selected';
    const     ATTR_MAX_SELECTED = 'max_selected';
    const     ATTR_REQUIRED     = 'required';

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_MAX_COUNT,
        self::ATTR_STATUS,
        self::ATTR_NAME,
        self::ATTR_MIN_SELECTED,
        self::ATTR_MAX_SELECTED,
        self::ATTR_REQUIRED,
    ];

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    const REQUIRED_ACTIVE   = 1;
    const REQUIRED_INACTIVE = 0;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class);
    }

    /**
     * @return array
     */
    public static function getStatusVariants()
    {
        return [
            static::STATUS_ACTIVE   => "Активно",
            static::STATUS_INACTIVE => "Выключено",

        ];
    }

    /**
     * @return array
     */
    public static function getRequiredVariants()
    {
        return [
            static::REQUIRED_ACTIVE   => 'Обязательная опция',
            static::REQUIRED_INACTIVE => 'Необязательная опция',

        ];
    }
}
