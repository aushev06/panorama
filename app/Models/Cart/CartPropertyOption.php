<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartPropertyOption
 * @property integer $id
 * @property integer $cart_property_id
 * @property integer $quantity
 * @property integer $price
 * @property integer $option_id
 *
 * @author Aushev Ibra <aushevibra@yandex.ru>
 */
class CartPropertyOption extends Model
{
    const ATTR_ID               = 'id';
    const ATTR_CART_PROPERTY_ID = 'cart_property_id';
    const ATTR_QUANTITY         = 'quantity';
    const ATTR_PRICE            = 'price';
    const ATTR_OPTION_ID        = 'option_id';

    const TABLE_NAME = 'cart_property_options';
    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::ATTR_OPTION_ID,
        self::ATTR_CART_PROPERTY_ID,
        self::ATTR_PRICE,
        self::ATTR_QUANTITY,
    ];

    //
}
