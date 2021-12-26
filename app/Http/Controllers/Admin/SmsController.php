<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 02.09.2019
 * Time: 22:01
 */

namespace App\Http\Controllers\Admin;

use App\Models\Sms\Sms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SmsController
{
    const TITLE = "Смс коды";
    const ROUTE_INDEX   = 'sms.index';

    public function index()
    {
        $activationCodes = Sms::getActivationCodes();
        return view('admin.sms.index', ['activationCodes' => $activationCodes]);
    }


    public function activate($created_at)
    {
        $query = Sms::getUserCodesByTime($created_at)->first();
        $activated = Sms::activatePhoneUser($query->login);

        if ( !$activated ) {
            throw new \Exception("Не удалось активировать!");
        }

        $this->destroy($created_at);

        return redirect()->route(static::ROUTE_INDEX);
    }

    public function destroy($created_at)
    {
        $query = Sms::getUserCodesByTime($created_at);
        if (!$query->delete()) {
            throw new \Exception("Не удалось удалить!");
        }

        return redirect()->route(static::ROUTE_INDEX);
    }
}
