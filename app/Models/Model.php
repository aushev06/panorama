<?php

namespace App\Models;

/**
 * Class Model
 *
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @author Ibra Aushev <aushevibra@yandex.ru>
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    const ATTR_CREATED_AT = 'created_at';
    const ATTR_UPDATED_AT = 'updated_at';
    const ATTR_DELETED_AT = 'deleted_at';
}
