<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\Departament;
use Illuminate\Foundation\Http\FormRequest;


class DepartamentService
{
    /**
     * @param FormRequest $request
     * @param Departament $model
     * @return Departament
     *
     * @author Ibra Aushev <aushevibra@yandex.ru>
     */
    public function save(FormRequest $request, Departament $model): Departament
    {
        $model->fill($request->all([
            Departament::ATTR_NAME,
            Departament::ATTR_DESCRIPTION,
        ]));

        if ($request->file('logo')) {
            $model->logo = $request->file('logo')->store('app/logo', 'public');
        }


        if ($model->save()) {
            $model->users()->sync($request->post('users'));
        }

        return $model;
    }
}
