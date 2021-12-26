<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @property string $key
 * @package App\Models
 * @author Aushev Ibra <aushevibra@yandex.ru>
 */
class Setting extends Model
{
    const ATTR_KEY   = 'key';
    const ATTR_VALUE = 'value';

    const SETTING_TILLYPAD_TOKEN     = 'TILLYPAD_TOKEN';
    const SETTING_DEMO_MRH_LOGIN     = 'DEMO_MRH_LOGIN';
    const SETTING_DEMO_MRH_PASSWORD  = 'DEMO_MRH_PASSWORD';
    const SETTING_DEMO_MRH_PASSWORD2 = 'DEMO_MRH_PASSWORD2';
    const SETTING_MRH_LOGIN          = 'MRH_LOGIN';
    const SETTING_MRH_PASSWORD       = 'MRH_PASSWORD';
    const SETTING_MRH_PASSWORD2      = 'MRH_PASSWORD2';
    const SETTING_TELEGRAM_BOT_ID    = 'TELEGRAM_BOT_ID';
    const SETTING_TELEGRAM_CHAT_ID   = 'TELEGRAM_CHAT_ID';
    const SETTING_TWILIO_SID         = 'TWILIO_SID';
    const SETTING_TWILIO_TOKEN       = 'TWILIO_TOKEN';
    const SETTING_TWILIO_PHONE       = 'TWILIO_PHONE';
    const SETTING_SMSPILOT_PHONE     = 'SMSPILOT_PHONE';
    const SETTING_SMSPILOT_APIKEY    = 'SMSPILOT_APIKEY';

    const SETTING_PHONE_SERVICE_STATUS = 'PHONE_SERVICE_STATUS';

    protected $primaryKey = 'key';

    protected $casts = [
        'key' => 'string'
    ];

    protected $fillable = [
        'key',
        'value'
    ];
}
