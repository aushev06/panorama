<?php
declare(strict_types=1);

namespace App\Filters;


use App\Models\Food\Food;
use App\Models\Food\FoodProperty;
use Illuminate\Http\Request;

class FoodFilter extends QueryFilter
{

    public function name(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Food::TABLE_NAME . '.' . Food::ATTR_NAME, 'LIKE', "%$value%");
    }

    public function id(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Food::TABLE_NAME . '.' . Food::ATTR_ID, $value);
    }

    public function price(?string $value)
    {
        $this->builder->where(FoodProperty::TABLE_NAME . '.price', $value);
    }

    public function category(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Food::TABLE_NAME . '.' . Food::ATTR_CATEGORY_ID, $value);
    }

    public function prices(array $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(
            [
                [FoodProperty::TABLE_NAME . '.' . FoodProperty::ATTR_PRICE, '>=', $value[0]],
                [FoodProperty::TABLE_NAME . '.' . FoodProperty::ATTR_PRICE, '<=', $value[1]],
            ]
        );
    }
}
