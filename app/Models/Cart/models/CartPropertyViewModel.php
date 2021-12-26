<?php
declare(strict_types=1);

namespace App\Models\Cart\models;


use App\Models\Cart\Cart;

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


    public function __construct($cartProperty)
    {
        $this->id       = $cartProperty->cart_property_id;
        $this->name     = $cartProperty->name;
        $this->img      = empty($cartProperty->img) ? asset('admin_assets/img/no_image.png') : asset('storage/' . $cartProperty->img);
        $this->sum      = $cartProperty->total_sum;
        $this->quantity = $cartProperty->quantity;
        $this->price    = $cartProperty->price;
    }


}
