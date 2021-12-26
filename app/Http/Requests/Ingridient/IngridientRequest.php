<?php

namespace App\Http\Requests\Ingridient;

use Illuminate\Foundation\Http\FormRequest;

class IngridientRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required'  => 'Заполните название',
            'foods.required' => 'Выберите блюда'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'foods' => 'required'
        ];
    }
}
