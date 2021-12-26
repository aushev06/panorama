<?php
declare(strict_types=1);

namespace App\Models\Cart\models;


use App\Models\Cart\Cart;
use App\Models\Cart\CartProperty;
use App\Repositories\Cart\CartRepository;

class CartViewModel
{
    /**
     * @var integer $id
     */
    public $id;
    const ATTR_ID = 'id';

    /**
     * @var double $total
     */
    public $total;
    const ATTR_TOTAL = 'total';

    /**
     * @var CartProperty[] $cartProperties
     */
    public $cartProperties = [];


    public function __construct(Cart $cart, CartRepository $cartRepository)
    {
        $this->id    = $cart->id;
        $this->total = $cart->total;
        // =======

        $propeties = $cartRepository->getPropertiesCart($cart->id);

        if ($propeties->count() > 0) {
            foreach ($propeties as $cartProperty) {
                $this->cartProperties[] = new CartPropertyViewModel($cartProperty);
            }
        }


    }
}
