<?php
declare(strict_types=1);

namespace App\Models\Food\models;


use App\Models\Food\Food;
use App\Models\Food\FoodInfo;
use App\Models\Food\FoodProperty;
use App\Models\Option\Option;
use App\Models\Option\OptionCategory;

class FoodViewModel
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
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var integer
     */
    public $category_id;

    /**
     * @var integer
     */
    public $status;

    /**
     * @var string
     */
    public $img;

    /**
     * @var string
     */
    public $category;

    /**
     * @var bool
     */
    public $active;

    /**
     * @var FoodProperty[]
     */
    public $properties;

    /**
     * @var FoodInfo
     */

    public $foodInfo;

    /**
     * @var FoodOptionView[]
     */
    public $options = [];

    /**
     * @var Food
     */
    public $food;


    public function __construct(Food $food)
    {
        $this->food = $food;


        $this->id          = $food->id;
        $this->name        = $food->name;
        $this->description = $food->description;
        $this->slug        = $food->slug;
        $this->category_id = $food->category_id;
        $this->status      = $food->status;
        $this->img         = $food->img;
        $this->category    = $food->categoryCache()['name'];
        $this->active      = $food::STATUS_ACTIVE === $food->status ? true : false;

        foreach ($food->properties as $property) {
            $this->properties[] = new FoodPropertyItem($property);
        }


        $options = $food->options->keyBy(function (Option $option) {
            return implode('_', [$option->option_category_id, $option->id]);
        });

        $optionCategoriesIds = $options->map(function (Option $item, $key) {
            return explode('_', $key)[0];
        });

        $optionCategories = OptionCategory::whereIn(OptionCategory::ATTR_ID, $optionCategoriesIds)->get();


        $this->foodInfo = new FoodInfoItem($food->foodInfo);

        foreach ($optionCategories as $optionCategory) {
            $this->options[] = new FoodOptionView($optionCategory, $options);
        }

        $this->food = $food;
    }
}
