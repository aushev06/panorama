<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Settings
 * @property string $key
 * @property string $value
 * @property int    $status
 * @property string $description
 * @package App\Models
 */
class Settings extends Model
{
    private $activeSettings;

    const CONFIG_KEY = 'settings';

    const SCHEDULE_WEEKDAYS_OPEN = 'schedule_weekdays_open'; // Открытие в будние дни
    const SCHEDULE_WEEKDAYS_CLOSE = 'schedule_weekdays_close'; // Закрытие в будние дни
    const SCHEDULE_WEEKDAYS_ORDERS_OPEN = 'schedule_weekdays_orders_open'; // Первый заказ в будние дни
    const SCHEDULE_WEEKDAYS_ORDERS_CLOSE = 'schedule_weekdays_orders_close'; // Последний заказ в будние дни
    const SCHEDULE_WEEKEND_OPEN = 'schedule_weekend_open'; // Открытие в выходные дни
    const SCHEDULE_WEEKEND_CLOSE = 'schedule_weekend_close'; // Закрытие в выходные дни
    const SCHEDULE_WEEKEND_ORDERS_OPEN = 'schedule_weekend_orders_open'; // Первый заказ в выходные дни
    const SCHEDULE_WEEKEND_ORDERS_CLOSE = 'schedule_weekend_orders_close'; // Последний заказ в выходные дни
    const SCHEDULE_EVERYDAY_ORDERS_OPEN = 'schedule_everyday_orders_open'; // Первый заказ на каждый день
    const SCHEDULE_EVERYDAY_ORDERS_CLOSE = 'schedule_everyday_orders_close'; // Последний заказ на каждый день
    const ORDERS_OFF = 'orders_off'; // Отключение корзины (заказов)

    const SCHEDULE_WEEKDAYS_OPEN_VALUE = '09:00'; // Открытие в будние дни
    const SCHEDULE_WEEKDAYS_CLOSE_VALUE = '22:00'; // Закрытие в будние дни
    const SCHEDULE_WEEKDAYS_ORDERS_OPEN_VALUE = '09:00'; // Первый заказ в будние дни
    const SCHEDULE_WEEKDAYS_ORDERS_CLOSE_VALUE = '21:30'; // Последний заказ в будние дни
    const SCHEDULE_WEEKEND_OPEN_VALUE = '10:00'; // Открытие в выходные дни
    const SCHEDULE_WEEKEND_CLOSE_VALUE = '22:00'; // Закрытие в выходные дни
    const SCHEDULE_WEEKEND_ORDERS_OPEN_VALUE = '10:00'; // Первый заказ в выходные дни
    const SCHEDULE_WEEKEND_ORDERS_CLOSE_VALUE = '21:30'; // Последний заказ в выходные дни
    const SCHEDULE_EVERYDAY_ORDERS_OPEN_VALUE = '09:00'; // Первый заказ на каждый день
    const SCHEDULE_EVERYDAY_ORDERS_CLOSE_VALUE = '21:30'; // Последний заказ на каждый день

    const ATTR_KEY         = 'key';
    const ATTR_VALUE       = 'value';
    const ATTR_STATUS      = 'status';
    const ATTR_DESCRIPTION = 'description';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;


    public static function getStatusVariants()
    {
        return [
            static::STATUS_ACTIVE   => 'Включен',
            static::STATUS_INACTIVE => 'Отключен',
        ];
    }

    public $timestamps    = false;
    protected $primaryKey = 'key';

    protected $casts = [
        'key' => 'string'
    ];

    protected $fillable = [
        'key',
        'value',
        'status',
        'description'
    ];

    public function getActiveSettings()
    {
        if (empty($this->activeSettings)) {
            $this->activeSettings = static::query()->active()->get()->keyBy('key')->all();
        }
        return $this->activeSettings;
    }

    public static function getActiveSettingsAll()
    {
        return self::query()->active()->get()->keyBy(Settings::ATTR_KEY)->all();
    }

    public static function getIsOrdersOff($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $result = false;

        if (isset($settings[Settings::ORDERS_OFF])) {
            $result = $settings[Settings::ORDERS_OFF];
        }

        return $result;
    }

    public static function getOrdersOpen($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $ordersOpen = Settings::SCHEDULE_EVERYDAY_ORDERS_OPEN_VALUE;
        $dayOfWeek = date('N');
        $isWeekdays = in_array($dayOfWeek, [1,2,3,4,5]);
        $isWeekend = in_array($dayOfWeek, [6,7]);

        if (isset($settings[Settings::SCHEDULE_EVERYDAY_ORDERS_OPEN])) {
            $_ordersOpen = $settings[Settings::SCHEDULE_EVERYDAY_ORDERS_OPEN];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKDAYS_ORDERS_OPEN]) && $isWeekdays) {
            $_ordersOpen = $settings[Settings::SCHEDULE_WEEKDAYS_ORDERS_OPEN];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKDAYS_OPEN]) && $isWeekdays) {
            $_ordersOpen = $settings[Settings::SCHEDULE_WEEKDAYS_OPEN];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKEND_ORDERS_OPEN]) && $isWeekend) {
            $_ordersOpen = $settings[Settings::SCHEDULE_WEEKEND_ORDERS_OPEN];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKEND_OPEN]) && $isWeekend) {
            $_ordersOpen = $settings[Settings::SCHEDULE_WEEKEND_OPEN];
        }

        if (!empty($_ordersOpen)) {
            $ordersOpen = $_ordersOpen->value;
        }

        return $ordersOpen;
    }

    public static function getOrdersClose($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $ordersClose = Settings::SCHEDULE_EVERYDAY_ORDERS_CLOSE_VALUE;
        $dayOfWeek = date('N');
        $isWeekdays = in_array($dayOfWeek, [1,2,3,4,5]);
        $isWeekend = in_array($dayOfWeek, [6,7]);

        if (isset($settings[Settings::SCHEDULE_EVERYDAY_ORDERS_CLOSE])) {
            $_ordersClose = $settings[Settings::SCHEDULE_EVERYDAY_ORDERS_CLOSE];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKDAYS_ORDERS_CLOSE]) && $isWeekdays) {
            $_ordersClose = $settings[Settings::SCHEDULE_WEEKDAYS_ORDERS_CLOSE];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKDAYS_CLOSE]) && $isWeekdays) {
            $_ordersClose = $settings[Settings::SCHEDULE_WEEKDAYS_CLOSE];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKEND_ORDERS_CLOSE]) && $isWeekend) {
            $_ordersClose = $settings[Settings::SCHEDULE_WEEKEND_ORDERS_CLOSE];
        } elseif (isset($settings[Settings::SCHEDULE_WEEKEND_CLOSE]) && $isWeekend) {
            $_ordersClose = $settings[Settings::SCHEDULE_WEEKEND_CLOSE];
        }

        if (!empty($_ordersClose)) {
            $ordersClose = $_ordersClose->value;
        }


        return $ordersClose;
    }

    public static function getWeekendOpen($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $result = config(self::CONFIG_KEY . '.' . Settings::SCHEDULE_WEEKEND_OPEN);

        if (isset($settings[Settings::SCHEDULE_WEEKEND_OPEN]) &&
            !empty($_result = $settings[Settings::SCHEDULE_WEEKEND_OPEN])
        ) {
            $result = $_result->value;
        }

        return $result;
    }

    public static function getWeekendClose($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $result = config(self::CONFIG_KEY . '.' . Settings::SCHEDULE_WEEKEND_CLOSE);

        if (isset($settings[Settings::SCHEDULE_WEEKEND_CLOSE]) &&
            !empty($_result = $settings[Settings::SCHEDULE_WEEKEND_CLOSE])
        ) {
            $result = $_result->value;
        }

        return $result;
    }

    public static function getWeekdaysOpen($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $result = config(self::CONFIG_KEY . '.' . Settings::SCHEDULE_WEEKDAYS_OPEN);

        if (isset($settings[Settings::SCHEDULE_WEEKDAYS_OPEN]) &&
            !empty($_result = $settings[Settings::SCHEDULE_WEEKDAYS_OPEN])
        ) {
            $result = $_result->value;
        }

        return $result;
    }

    public static function getWeekdaysClose($activeSettings = null)
    {
        $settings = $activeSettings ?: static::getActiveSettingsAll();
        $result = config(self::CONFIG_KEY . '.' . Settings::SCHEDULE_WEEKDAYS_CLOSE);

        if (isset($settings[Settings::SCHEDULE_WEEKDAYS_CLOSE]) &&
            !empty($_result = $settings[Settings::SCHEDULE_WEEKDAYS_CLOSE])
        ) {
            $result = $_result->value;
        }

        return $result;
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where(self::ATTR_STATUS, 1);
    }
}
