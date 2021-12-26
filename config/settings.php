<?php
use App\Models\Settings;

$weekdaysOpen  = '09:00';
$weekdaysClose = '22:00';
$weekendOpen   = '10:00';
$weekendClose  = '22:00';
$ordersOpen    = '09:00';
$ordersClose   = '21:30';

return [
    Settings::SCHEDULE_WEEKDAYS_OPEN         => $weekdaysOpen,
    Settings::SCHEDULE_WEEKDAYS_CLOSE        => $weekdaysClose,
    Settings::SCHEDULE_WEEKEND_OPEN          => $weekendOpen,
    Settings::SCHEDULE_WEEKEND_CLOSE         => $weekendClose,
    Settings::SCHEDULE_EVERYDAY_ORDERS_OPEN  => $ordersOpen,
    Settings::SCHEDULE_EVERYDAY_ORDERS_CLOSE => $ordersClose,
];
