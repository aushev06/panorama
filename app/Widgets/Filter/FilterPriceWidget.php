<?php

namespace App\Widgets\Filter;

use App\Models\Food\FoodProperty;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;

class FilterPriceWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $prices = FoodProperty::select(DB::raw("MIN(" . FoodProperty::ATTR_PRICE . ") as min, MAX(" . FoodProperty::ATTR_PRICE . ") as max"))->first();

        return view('widgets.filter.filter_price_widget', [
            'prices' => $prices,
        ]);
    }
}
