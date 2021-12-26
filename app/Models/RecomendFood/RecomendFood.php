<?php

namespace App\Models\RecomendFood;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecomendFood
 *
 * @property integer $id
 * @property integer $food_od
 * @property integer $food_recomend_id
 */
class RecomendFood extends Model
{
    const ATTR_ID               = 'id';
    const ATTR_FOOD_ID          = 'food_id';
    const ATTR_FOOD_RECOMEND_ID = 'food_recomend_id';

    const TABLE_NAME = 'recomend_foods';
}
