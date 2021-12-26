<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 02.09.2019
 * Time: 22:26
 */

namespace App\Repositories\Promotions;


use App\Models\PromotionCards\PromotionCards;
use App\Models\Promotions\Promotions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class PromotionsRepository
{
    public function get()
    {
//        Artisan::call("cache:clear");
        return Cache::remember(__CLASS__ . __METHOD__, 60, function () {
            return Promotions::query()->where('status', '=', '1')->get();
        });
    }

    public function getCards()
    {
        return Cache::remember(__CLASS__ . __METHOD__, 1440, function () {
            return PromotionCards::query()->where('status', '=', '1')->get();
        });
    }

}
