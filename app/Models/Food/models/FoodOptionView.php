<?php


namespace App\Models\Food\models;


use App\Models\Option\Option;
use App\Models\Option\OptionCategory;

class FoodOptionView
{
    /**
     * @var string
     */
    public $categoryName;

    /**
     * @var bool
     */
    public $required;

    /**
     * @var Option[]
     */
    public $items = [];

    public function __construct(OptionCategory $category = null, $options = [])
    {
        $this->categoryName = $category->name;
        $this->required     = intval($category->required) === 1;

        foreach ($options as $option) {
            if ($option->option_category_id === $category->id) {
                $this->items[] = $option;
            }
        }
    }

}
