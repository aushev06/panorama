<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $food_id
 * @property string $weight
 * @property string $carbohydrates
 * @property string $fat
 * @property string $protein
 * @property string $calories
 */
class FoodInfo extends Model
{
    const TABLE_NAME = 'food_info';

    const ATTR_ID           = 'id';
    const ATTR_FOOD_ID      = 'food_id';
    const ATTR_WEIGHT       = 'weight';
    const ATTR_CARBOHYDRATE = 'carbohydrates';
    const ATTR_FAT          = 'fat';
    const ATTR_PROTEIN      = 'protein';
    const ATTR_CALORIES     = 'calories';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::ATTR_FOOD_ID;

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_WEIGHT,
        self::ATTR_FOOD_ID,
        self::ATTR_CALORIES,
        self::ATTR_CARBOHYDRATE,
        self::ATTR_FAT,
        self::ATTR_PROTEIN,
    ];

}
