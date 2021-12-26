<?php

namespace App\Providers;

use App\Models\Ingridient\Ingridient;
use App\Models\Ingridient\IngridientFoods;
use App\Models\Order\Order;
use App\Models\Setting;
use App\Observers\IngridientFoodsObserver;
use App\Observers\IngridientObserver;
use App\Observers\OrderObserver;
use App\Services\Smspilot\SmspilotService;
use Idma\Robokassa\Payment;
use Illuminate\Support\Facades\Cache;
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
        $this->getSettings();
        Schema::defaultStringLength(191);
        Order::observe(OrderObserver::class);
        IngridientFoods::observe(IngridientFoodsObserver::class);
        Ingridient::observe(IngridientObserver::class);

        $this->app->singleton('Payment', function () {
            return new Payment(env('DEMO_MRH_LOGIN'), env('DEMO_MRH_PASSWORD'), env('DEMO_MRH_PASSWORD2'),
                env('TEST_ROBOKASSA', false));
        });

        $this->app->singleton('Twilio', function () {
            return new TwilioService();
        });

        $this->app->singleton('Smspilot', function () {
            return new SmspilotService();
        });


    }

    private function getSettings()
    {
        try {
            return Cache::rememberForever('settings', function () {
                return Setting::query()->select([Setting::ATTR_KEY, Setting::ATTR_VALUE])->get()->keyBy(Setting::ATTR_KEY)->toArray();
            });
        } catch (\Throwable $exception) {
            return [];
        }
    }
}
