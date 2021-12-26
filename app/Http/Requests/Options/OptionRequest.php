<?php

namespace App\Http\Requests\Options;

use App\Models\Option\Option;
use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
     * @return array
     */
    public function messages()
    {
        return [
            implode('.', [Option::ATTR_NAME, 'required'])               => "Заполните название",
            implode('.', [Option::ATTR_PRICE, 'required'])              => "Укажите цену",
            implode('.', [Option::ATTR_STATUS, 'required'])             => "Выберите статус",
            implode('.', [Option::ATTR_OPTION_CATEGORY_ID, 'required']) => "Выберите категорию",
            implode('.', [Option::ATTR_MULTIPLIER, 'required'])         => "Укажите макс. кол-во",
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
            Option::ATTR_NAME               => ['required'],
            Option::ATTR_STATUS             => ['required'],
            Option::ATTR_PRICE              => ['required'],
            Option::ATTR_OPTION_CATEGORY_ID => ['required'],
            Option::ATTR_MULTIPLIER         => ['required'],
        ];
    }
}
