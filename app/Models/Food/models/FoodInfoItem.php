<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 18.09.2019
 * Time: 21:54
 */

namespace App\Models\Food\models;


use App\Models\Food\FoodInfo;

class FoodInfoItem
{
    public $id;
    public $food_id;
    public $weight;
    public $carbohydrates;
    public $fat;
    public $protein;
    public $calories;

    public function __construct(?FoodInfo $foodInfo)
    {
        if (null !== $foodInfo) {
            $this->id            = $foodInfo->id;
            $this->food_id       = $foodInfo->food_id;
            $this->weight        = $foodInfo->weight;
            $this->carbohydrates = $foodInfo->carbohydrates;
            $this->fat           = $foodInfo->fat;
            $this->protein       = $foodInfo->protein;
            $this->calories      = $foodInfo->calories;
        }
    }
}
