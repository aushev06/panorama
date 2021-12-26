<?php

namespace App\Models\Option;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OptionFood
 *
 * @property integer $id
 * @property integer $option_id
 * @property integer $food_id
 *
 *
 * @package App\Models\Option
 */
class OptionFood extends Model
{
    const ATTR_ID        = 'id';
    const ATTR_OPTION_ID = 'option_id';
    const ATTR_FOOD_ID   = 'food_id';

    const TABLE_NAME = 'option_foods';
    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_FOOD_ID,
        self::ATTR_OPTION_ID
    ];
}
