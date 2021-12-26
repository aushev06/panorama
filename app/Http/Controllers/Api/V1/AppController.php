<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Artisan;

class AppController extends Controller
{

    public function settings()
    {
        $settings = [
            'SEND_PHONE_MESSAGE_OPERATION' => config('app.SEND_PHONE_MESSAGE_OPERATION'),
        ];

        return ['settings' => $settings];
    }

    public function siteSettings() {
        $siteSettings = SiteSetting::all('key', 'value');
        $settings = [];
        foreach ($siteSettings as $setting) {
            $settings[$setting['key']] = $setting['value'];
        }

        return ['siteSettings' => $settings];
    }

    public function cacheClear()
    {
        Artisan::call("cache:clear");
        return back();
    }

}
