<?php

namespace App\Models\Cart;

use App\Models\Food\FoodProperty;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cart_id
 * @property integer $food_property_id
 * @property integer $price
 * @property integer $quantity
 */
class CartProperty extends Model
{
    const ATTR_ID               = 'id';
    const ATTR_CART_ID          = 'cart_id';
    const ATTR_FOOD_PROPERTY_ID = 'food_property_id';
    const ATTR_PRICE            = 'price';
    const ATTR_QUANTITY         = 'quantity';

    const TABLE_NAME = 'cart_properties';

    protected $table = self::TABLE_NAME;

    protected $fillable = [self::ATTR_ID, self::ATTR_CART_ID, self::ATTR_QUANTITY, self::ATTR_FOOD_PROPERTY_ID, self::ATTR_FOOD_PROPERTY_ID];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
