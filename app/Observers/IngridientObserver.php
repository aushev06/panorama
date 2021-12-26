<?php

namespace App\Observers;

use App\Models\Food\Food;
use App\Models\Ingridient\Ingridient;
use Illuminate\Support\Facades\Log;

class IngridientObserver
{
    /**
     * Handle the ingridient "created" event.
     *
     * @param  \App\Models\Ingridient\Ingridient $ingridient
     * @return void
     */
    public function created(Ingridient $ingridient)
    {
        //
    }

    /**
     * Handle the ingridient "updated" event.
     *
     * @param  \App\Models\Ingridient\Ingridient $ingridient
     * @return void
     */
    public function updated(Ingridient $ingridient)
    {
        //
    }

    /**
     * Handle the ingridient "deleted" event.
     *
     * @param  \App\Models\Ingridient\Ingridient $ingridient
     * @return void
     */
    public function deleted(Ingridient $ingridient)
    {
        $ingridient->foods()->update([
            Food::TABLE_NAME . '.' . Food::ATTR_STATUS => Food::STATUS_ACTIVE
        ]);
        $ingridient->foods()->sync([]);
        Log::info("ING", [$ingridient->foods()]);
        Log::info("ING", [$ingridient->foods()->sync([])]);

    }

    /**
     * Handle the ingridient "restored" event.
     *
     * @param  \App\Models\Ingridient\Ingridient $ingridient
     * @return void
     */
    public function restored(Ingridient $ingridient)
    {
        //
    }

    /**
     * Handle the ingridient "force deleted" event.
     *
     * @param  \App\Models\Ingridient\Ingridient $ingridient
     * @return void
     */
    public function forceDeleted(Ingridient $ingridient)
    {
        Log::info("ING", [$ingridient]);
        $ingridient->foods()->sync([]);
    }
}
