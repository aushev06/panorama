<?php

namespace App\Services\Phone;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PhoneService {

    protected function generateAndSaveCode($login, $count = 6) {
        $min = 10**($count - 1);
        $max = (10**$count) - 1;
        $code = rand($min, $max);
        DB::table('user_auth_codes')->insert(['login' => $login, 'code' => $code, 'created_at' => Carbon::now()]);
        return $code;
    }

    protected function generateCode($count = 6) {
        $min = 10**($count - 1);
        $max = (10**$count) - 1;
        return rand($min, $max);
    }

    protected function saveGeneratedCode($login, $code) {
        DB::table('user_auth_codes')->insert(['login' => $login, 'code' => $code, 'created_at' => Carbon::now()]);
    }


    public function hasAuthCodes(string $login) {
        $codes = DB::table('user_auth_codes')->where(['login' => $login])->first();

        if($codes) return true;
        else return false;
    }
}
