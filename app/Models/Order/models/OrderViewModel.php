<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 15.09.2019
 * Time: 21:33
 */

namespace App\Models\Order\models;


use App\Models\Cart\CartProperty;
use App\Models\Cart\models\CartPropertyViewModel;
use App\Models\Order\Order;
use App\Repositories\Order\OrderRepository;

class OrderViewModel
{
    /**
     * @var integer
     */
    public $id;
    const ATTR_ID = 'id';

    /**
     * @var string
     */
    public $name;
    const ATTR_NAME = 'name';
    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $address;

    /**
     * @var integer
     */
    public $home;

    /**
     * @var integer
     */
    public $floor;

    /**
     * @var integer
     */
    public $porch;

    /**
     * @var string
     */
    public $time_delivery;

    /**
     * @var string
     */
    public $date_delivery;

    /**
     * @var string
     */
    public $organization;

    /**
     * @var integer
     */
    public $pay_type;

    /**
     * @var integer
     */
    public $total;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var integer
     */
    public $status;
    /**
     * @var string
     */
    public $house;
    /**
     * @var string
     */
    public $apartment;
    /**
     * @var string
     */
    public $entrance;
    /**
     * @var string
     */
    public $intercom;
    /**
     * @var string
     */
    public $building;

    /**
     * @var string
     */
    public $street;


    /**
     * @var CartProperty[]
     */
    public $foodProperties;

    const ATTR_PHONE         = 'phone';
    const ATTR_ADDRESS       = 'address';
    const ATTR_HOME          = 'home';
    const ATTR_FLOOR         = 'floor';
    const ATTR_PORCH         = 'porch';
    const ATTR_TIME_DELIVERY = 'time_delivery';
    const ATTR_DATE_DELIVERY = 'date_delivery';
    const ATTR_ORGANIZATION  = 'organization';
    const ATTR_PAY_TYPE      = 'pay_type';
    const ATTR_USER_ID       = 'user_id';
    const ATTR_TOTAL         = 'total';
    const ATTR_COMMENT       = 'comment';
    const ATTR_STATUS        = 'status';
    const ATTR_STREET        = 'street';
    const ATTR_HOUSE         = 'house';
    const ATTR_APARTMENT     = 'apartment';
    const ATTR_ENTRANCE      = 'entrance';
    const ATTR_INTERCOM      = 'intercom';
    const ATTR_BUILDING      = 'building';


    public function __construct(Order $order, OrderRepository $orderRepository)
    {
        foreach ($order->getAttributes() as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;

                if (property_exists($this, $attribute) && $this->$attribute == $order::ATTR_STATUS) {
                    $this->status = $order::getStatusesVariants()[$value];
                }
            }
        }

        $propeties = $orderRepository->getOrderProperties($order->cart_id);

        if ($propeties->count() > 0) {
            foreach ($propeties as $cartProperty) {
                $this->foodProperties[] = new CartPropertyViewModel($cartProperty);
            }
        }


    }

    public function attributes()
    {
        return [
            self::ATTR_PHONE         => 'Телефон',
            self::ATTR_TIME_DELIVERY => 'Время доставки',
            self::ATTR_DATE_DELIVERY => 'Дата доставки',
            self::ATTR_ORGANIZATION  => 'Организация',
            self::ATTR_PAY_TYPE      => 'Тип оплаты',
            self::ATTR_NAME          => 'Имя',
            self::ATTR_TOTAL         => 'Сумма заказа',
            self::ATTR_COMMENT       => 'Коммент',
            self::ATTR_STATUS        => 'Статус',
            self::ATTR_STREET        => 'Адрес',
            self::ATTR_BUILDING      => 'Корпус',
            self::ATTR_ENTRANCE      => 'Подъезд',
            self::ATTR_APARTMENT     => 'Квартира',
            self::ATTR_HOUSE         => 'Дом',
        ];
    }
}
