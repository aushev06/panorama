<?php

namespace App\Models\Ingridient;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IngridientFoods
 * @property integer $id
 * @property integer $food_id
 * @property integer $ingridient_id
 * @property integer $status
 */
class IngridientFoods extends Model
{
    const ATTR_ID            = 'id';
    const ATTR_FOOD_ID       = 'food_id';
    const ATTR_INGRIDIENT_ID = 'ingridient_id';
    const ATTR_STATUS        = 'status';

    const TABLE_NAME = 'ingridient_foods';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;


    protected $fillable = [self::ATTR_FOOD_ID, self::ATTR_INGRIDIENT_ID, self::ATTR_STATUS];


}
