<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 15.09.2019
 * Time: 20:25
 */

namespace App\Filters;


use App\Models\Order\Order;

class OrderFilter extends QueryFilter
{


    public function name(?string $value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Order::ATTR_NAME, 'like', '%' . $value . '%');
    }

    public function total($value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Order::ATTR_TOTAL, $value);
    }

    public function date($value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where(Order::ATTR_DATE_DELIVERY, $value);
    }
}
