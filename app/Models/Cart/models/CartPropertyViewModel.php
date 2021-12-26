<?php
declare(strict_types=1);

namespace App\Models\Cart\models;


use App\Models\Cart\Cart;
use App\Models\Cart\CartFoodOption;
use App\Models\Cart\CartProperty;
use App\Models\Food\FoodProperty;
use Illuminate\Support\Facades\DB;

class CartPropertyViewModel
{

    /**
     * @var integer $id
     */
    public $id;
    const ATTR_ID = 'id';

    /**
     * @var string $name
     */
    public $name;
    const ATTR_NAME = 'name';

    /**
     * @var string $full
     */
    public $full;
    const ATTR_FULL = 'full';

    /**
     * @var integer $price
     */
    public $price;
    const ATTR_PRICE = 'price';

    /**
     * @var string $img
     */
    public $img;
    const ATTR_IMG = 'img';

    /**
     * @var integer $quantity
     */
    public $quantity;
    const ATTR_QUANTITY = 'quantity';

    /**
     * @var integer $sum
     */
    public $sum;
    const ATTR_SUM = 'sum';

    /**
     * @var int
     */
    public $food_id;

    /**
     * @var int
     */
    public $foodPropertyId;


    /**
     * @var CartPropertyOptionApiView[]
     */
    public $options = [];

    public function __construct(CartProperty $cartProperty)
    {
        $img = asset('admin_assets/img/no_image.png');
        if( !empty($cartProperty->img) || !empty($cartProperty->mainIMG) )
        {
            if ( empty($cartProperty->img) ) $img = url('storage/' . $cartProperty->mainIMG);
            else                             $img = url('storage/' . $cartProperty->img);
        }

        $name = $cartProperty->name === $cartProperty->cart_property_name ? $cartProperty->name : $cartProperty->name . ' (' . $cartProperty->cart_property_name . ')';

        $this->id             = $cartProperty->cart_property_id;
        $this->name           = $name;
        $this->img            = $img;
//        $this->img            = empty($cartProperty->img) ? asset('admin_assets/img/no_image.png') : url('storage/' . $cartProperty->img);
        $this->sum            = $cartProperty->total_sum;
        $this->quantity       = $cartProperty->quantity;
        $this->price          = $cartProperty->price;
        $this->food_id        = $cartProperty->food_id;
        $this->foodPropertyId = $cartProperty->food_property_id;


        foreach ($cartProperty->options as $key => $option) {
            $item           = new CartPropertyOptionApiView();
            $item->id       = $option->id;
            $item->name     = $option->name;
            $item->quantity = $option->pivot->quantity;

            $this->options[] = $item;
            $this->sum       += ($option->pivot->quantity * $option->pivot->price) * $this->quantity;

        }

    }


}
