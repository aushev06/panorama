<?php
declare(strict_types=1);

namespace App\Services;


use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param FormRequest $request
     * @param User $model
     * @return User
     *
     * @author Ibra Aushev <aushevibra@yandex.ru>
     */
    public function save(FormRequest $request, User $model) : User
    {
        $model->fill($request->all([
            User::ATTR_NAME,
            User::ATTR_EMAIL,
            User::ATTR_PASSWORD,
        ]));
        $model->remember_token = Str::random(10);

        if (null !== $request->post('password')) {
            $model->password = Hash::make($request->post('password'));
        }

        $model->save();

        return $model;
    }
}
