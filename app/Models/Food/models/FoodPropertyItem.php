<?php
declare(strict_types=1);

namespace App\Models\Food\models;


use App\Models\Food\FoodProperty;

class FoodPropertyItem
{
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $price;

    /**
     * @var integer
     */
    public $old_price;

    /**
     * @var integer
     */
    public $sort;

    /**
     * @var integer
     */
    public $is_visible;

    /**
     * @var integer
     */
    public $food_id;

    /**
     * @var string
     */
    public $img;

    public function __construct(FoodProperty $property)
    {
        $this->id         = $property->id;
        $this->name       = $property->name;
        $this->price      = $property->price;
        $this->old_price  = $property->old_price;
        $this->is_visible = $property->is_visible;
        $this->sort       = $property->sort;
        $this->food_id    = $property->food_id;
        $this->img        = $property->img;
    }
}
