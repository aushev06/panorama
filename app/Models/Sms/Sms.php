<?php

namespace App\Models\Sms;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sms extends Model
{
    const ATTR_LOGIN              = "login";
    const ATTR_CODE               = "code";
    const ATTR_CREATED_AT         = "created_at";

    protected $fillable = [
        self::ATTR_LOGIN,
        self::ATTR_CODE,
        self::ATTR_CREATED_AT,
    ];

    public static function getActivationCodes()
    {
        return DB::table('user_auth_codes')->get();
    }

    public static function getUserCodesByTime($created_at)
    {
        return DB::table('user_auth_codes')->where('created_at', '=', $created_at);
    }

    public static function activatePhoneUser(string $phone)
    {
        $user = User::query()->where('phone', '=', $phone)->first();
        return $user->markPhoneAsVerified();
    }

}
