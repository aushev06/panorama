<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SiteSetting
 * @property string $key
 * @property string $value
 * @property string $description
 * @package App\Models
 */
class SiteSetting extends Model
{
    const ATTR_KEY         = 'key';
    const ATTR_VALUE       = 'value';
    const ATTR_DESCRIPTION = 'description';

    public $timestamps    = false;
    protected $primaryKey = 'key';

    protected $casts = [
        'key' => 'string'
    ];

    protected $fillable = [
        'key',
        'value',
        'description'
    ];
}
