<?php

namespace App\Observers;

use App\Models\Food\Food;
use App\Models\Ingridient\IngridientFoods;
use Illuminate\Support\Facades\Log;

class IngridientFoodsObserver
{
    /**
     * Handle the ingridient foods "created" event.
     *
     * @param  \App\Models\Ingridient\IngridientFoods $ingridientFoods
     * @return void
     */
    public function created(IngridientFoods $ingridientFoods)
    {
        //
    }

    /**
     * Handle the ingridient foods "updated" event.
     *
     * @param  \App\Models\Ingridient\IngridientFoods $ingridientFoods
     * @return void
     */
    public function updated(IngridientFoods $ingridientFoods)
    {
        Log::info('status', [$ingridientFoods->status]);
        if ($ingridientFoods::STATUS_ACTIVE === (int)$ingridientFoods->status) {
            Log::info('statustut', [$ingridientFoods->status]);
            Food::where(Food::ATTR_ID, $ingridientFoods->food_id)->update([
                Food::ATTR_STATUS => Food::STATUS_ACTIVE
            ]);

            IngridientFoods::where(IngridientFoods::ATTR_FOOD_ID, $ingridientFoods->food_id)->update([
                IngridientFoods::ATTR_STATUS => IngridientFoods::STATUS_ACTIVE
            ]);
        } else {
            Food::where(Food::ATTR_ID, $ingridientFoods->food_id)->update([
                Food::ATTR_STATUS => Food::STATUS_INACTIVE
            ]);

            IngridientFoods::where(IngridientFoods::ATTR_FOOD_ID, $ingridientFoods->food_id)
                ->update([
                    IngridientFoods::ATTR_STATUS => IngridientFoods::STATUS_INACTIVE
                ]);
        }
    }

    /**
     * Handle the ingridient foods "deleted" event.
     *
     * @param  \App\Models\Ingridient\IngridientFoods $ingridientFoods
     * @return void
     */
    public function deleted(IngridientFoods $ingridientFoods)
    {
        Food::where(Food::ATTR_ID, $ingridientFoods->food_id)->update([
            Food::ATTR_STATUS => Food::STATUS_ACTIVE
        ]);

        Log::info('tut', [$ingridientFoods->status]);
        Log::info('update', [$update]);
    }

    /**
     * Handle the ingridient foods "restored" event.
     *
     * @param  \App\Models\Ingridient\IngridientFoods $ingridientFoods
     * @return void
     */
    public function restored(IngridientFoods $ingridientFoods)
    {
        Food::where(Food::ATTR_ID, $ingridientFoods->food_id)->update([
            Food::ATTR_STATUS => Food::STATUS_ACTIVE
        ]);
        Log::info('tut', [$ingridientFoods->status]);
        Log::info('update', [$update]);
    }

    /**
     * Handle the ingridient foods "force deleted" event.
     *
     * @param  \App\Models\Ingridient\IngridientFoods $ingridientFoods
     * @return void
     */
    public function forceDeleted(IngridientFoods $ingridientFoods)
    {

        $update = Food::where(Food::ATTR_ID, $ingridientFoods->food_id)->update([
            Food::ATTR_STATUS => Food::STATUS_ACTIVE
        ]);
        Log::info('tut', [$ingridientFoods->status]);
        Log::info('update', [$update]);
    }
}
