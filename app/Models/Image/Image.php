<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $image
 */
class Image extends Model
{
    const ATTR_ID       = 'id';
    const ATTR_MODEL    = 'model';
    const ATTR_MODEL_ID = 'model_id';
    const ATTR_IMAGE    = 'image';

    const TABLE_NAME = 'images';
    protected $table    = 'images';
    protected $fillable = [self::ATTR_ID, self::ATTR_IMAGE, self::ATTR_MODEL, self::ATTR_MODEL_ID];

    const MODEL_FOOD = 'App\Models\Food\Food';
}
