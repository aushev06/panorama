<?php

namespace App\Models\Food;

use App\Models\Option\Option;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FoodProperty
 *
 * @property integer $id
 * @property string $name
 * @property float $price
 * @property float $old_price
 * @property integer $sort
 * @property integer $is_visible
 * @property integer $food_id
 * @property string $img
 */
class FoodProperty extends Model
{
    const ATTR_ID         = 'id';
    const ATTR_NAME       = 'name';
    const ATTR_PRICE      = 'price';
    const ATTR_OLD_PRICE  = 'old_price';
    const ATTR_SORT       = 'sort';
    const ATTR_IS_VISIBLE = 'is_visible';
    const ATTR_IMG        = 'img';
    const ATTR_FOOD_ID    = 'food_id';

    const IS_VISIBLE    = 1;
    const IS_NO_VISIBLE = 0;

    const TABLE_NAME = "food_properties";
    protected $table = self::TABLE_NAME;

    protected $fillable   = [self::ATTR_NAME,
                             self::ATTR_PRICE,
                             self::ATTR_OLD_PRICE,
                             self::ATTR_SORT,
                             self::ATTR_IS_VISIBLE,
                             self::ATTR_IMG,
                             self::ATTR_FOOD_ID];
    public    $timestamps = false;


    public static function getStatusVariants()
    {
        return [
            static::IS_VISIBLE    => 'Активен',
            static::IS_NO_VISIBLE => 'Неактивен',
        ];
    }

    public function getImgAttribute($value)
    {
        return !$value ? $this->getFoodImage($this->food_id) : url('storage/' . $value);
    }

    private function getFoodImage($id)
    {
        $food = Food::query()->where('id', '=', $id)->first();
        return $food->img;
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'cart_food_options', 'food_property_id', 'option_id');
    }
}
