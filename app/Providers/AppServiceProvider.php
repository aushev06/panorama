<?php

namespace App\Providers;

use App\Models\Ingridient\Ingridient;
use App\Models\Ingridient\IngridientFoods;
use App\Models\Order\Order;
use App\Observers\IngridientFoodsObserver;
use App\Observers\IngridientObserver;
use App\Observers\OrderObserver;
use Idma\Robokassa\Payment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Order::observe(OrderObserver::class);
        IngridientFoods::observe(IngridientFoodsObserver::class);
        Ingridient::observe(IngridientObserver::class);

        $this->app->singleton('Payment', function () {

            $robokassaLogin  = env('DEMO_MRH_LOGIN', 'Panorama06');
            $robokassaIsTest = env('TEST_ROBOKASSA', false);

            if ($robokassaIsTest) {
                $robokassaPass = env('TEST_MRH_PASSWORD', 't4Z7ZHtmPwcNM76l6ZnK');
                $robokassaPass2 = env('TEST_MRH_PASSWORD2', 'bX32l26STXuDB7qmSMrK');
            } else {
                $robokassaPass = env('TEST_MRH_PASSWORD', 't4Z7ZHtmPwcNM76l6ZnK');
                $robokassaPass2 = env('TEST_MRH_PASSWORD2', 'bX32l26STXuDB7qmSMrK');
            }

            return new Payment(
                $robokassaLogin,
                $robokassaPass,
                $robokassaPass2,
                $robokassaIsTest
            );
        });
    }
}
