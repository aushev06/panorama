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
     * @var integer $parent_id
     */
    public $parent_id;


    /**
     * @var integer
     */
    public $count;
    /**
     * @var FoodViewModel[]
     */
    public $foodProperties;
    /**
     * @var self
     */
    public $child;

    public function __construct(Category $model)
    {
        $this->id        = $model->id;
        $this->icon      = $model->icon;
        $this->img       = $model->img;
        $this->name      = $model->name;
        $this->slug      = $model->slug;
        $this->count     = $model->foods()->count();
        $this->status    = $model->status;
        $this->parent_id = $model->parent_id;

        foreach ($model->childCategories as $category) {
            $child[] = new CategoryViewModel($category);
        }

        $this->child = $child ?? [];

        foreach ($model->foods()->get() as $food) {
            $this->foodProperties[] = new FoodViewModel($food);
        }

    }
}
