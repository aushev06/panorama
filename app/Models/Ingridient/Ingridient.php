<?php

namespace App\Models\Ingridient;

use App\Models\Food\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ingridient
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class Ingridient extends Model
{
    use SoftDeletes;

    const ATTR_ID     = 'id';
    const ATTR_NAME   = 'name';
    const ATTR_STATUS = 'status';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [self::ATTR_NAME, self::ATTR_STATUS];

    public static function getStatusVariants()
    {
        return [
            static::STATUS_ACTIVE   => 'Активный',
            static::STATUS_INACTIVE => 'Не активный',
        ];
    }

    public function assignFood(int $foodID)
    {
        $checkExist = IngridientFoods::where([
            [IngridientFoods::ATTR_FOOD_ID, $foodID],
            [IngridientFoods::ATTR_INGRIDIENT_ID, $this->id]
        ])->first();

        if (null === $checkExist) {
            IngridientFoods::create([
                IngridientFoods::ATTR_INGRIDIENT_ID => $this->id,
                IngridientFoods::ATTR_FOOD_ID       => $foodID,
                IngridientFoods::ATTR_STATUS        => IngridientFoods::STATUS_ACTIVE
            ]);

            return true;
        }

        return false;
    }


    public function foods()
    {
        return $this->belongsToMany(
            Food::class,
            IngridientFoods::class,
            IngridientFoods::ATTR_INGRIDIENT_ID,
            IngridientFoods::ATTR_FOOD_ID
        )
            ->withPivot([self::ATTR_STATUS]);
    }
}
