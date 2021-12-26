<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 07.10.2019
 * Time: 17:43
 */

namespace App\Services\Ingridient;


use App\Http\Requests\Ingridient\IngridientRequest;
use App\Models\Ingridient\Ingridient;

class IngridientService
{
    /**
     * @param IngridientRequest $request
     * @return Ingridient
     */
    public function save(IngridientRequest $request, Ingridient $model): Ingridient
    {

        $model->fill($request->all([$model::ATTR_NAME, $model::ATTR_STATUS]));
        $model->save();


        $model->foods()->sync($request->post('foods'));


        return $model;

    }
}
