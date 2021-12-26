<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 02.10.2019
 * Time: 21:16
 */

namespace App\Models\Category\models;


use App\Models\Category\Category;
use App\Models\Food\models\FoodViewModel;

class CategoryViewModel
{
    /**
     * @var integer $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var string $image
     */
    public $img;

    /**
     * @var string $slug
     */
    public $slug;


    /**
     * @var integer
     */
    public $count;
    /**
     * @var FoodViewModel[]
     */
    public $foodProperties = [];

    public function __construct(Category $model)
    {
        $this->id    = $model->id;
        $this->icon  = $model->icon;
        $this->img   = $model->img;
        $this->name  = $model->name;
        $this->slug  = $model->slug;
        $this->count = $model->foods()->count();


        foreach ($model->foods as $food) {
            $this->foodProperties[] = new FoodViewModel($food);
        }

    }
}
