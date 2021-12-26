<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['string', 'nullable', 'email', 'max:255', 'unique:' . User::TABLE_NAME],
            'phone'    => ['required', 'string', 'min:11', 'max:11', 'unique:' . User::TABLE_NAME],
//            'phone'    => ['string', 'max:255', 'unique:' . User::TABLE_NAME],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Имя обязательно для заполнения',
            'phone.required' => 'Номер телефона обязательно для заполнения',
            'password.required' => 'Поле Пароль обязательно для заполнения',
            'phone.max' => 'Телефон должен состоять из 11 символов',
            'phone.min' => 'Телефон должен состоять из 11 символов',
            'email.unique' => 'Этот Email-адрес уже используется',
            'phone.unique' => 'Этот телефон уже используется',
            'password.min' => 'Пароль должен состоять минимум из 8 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
