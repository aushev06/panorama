<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConsoleController extends Controller
{
    public function cacheClear()
    {
        Artisan::call("cache:clear");
        Artisan::call('migrate');
    }

    public function migrate()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
}
