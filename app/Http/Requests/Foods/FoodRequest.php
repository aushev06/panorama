<?php

namespace App\Http\Requests\Foods;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name.required'                      => 'Заполните название',
            'category_id.required'               => 'Выберите категорию',
            'FoodProperty.*.price.required'      => 'Установите цену',
            'FoodProperty.*.is_visible.required' => 'Выберите статус вариации'
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
            'name'                      => 'required',
            'category_id'               => 'required|integer',
            'FoodProperty'              => 'required',
            'FoodProperty.*.price'      => 'required',
            'FoodProperty.*.is_visible' => 'required|integer',
            'FoodProperty.*.name'       => 'required|string',
        ];
    }
}
