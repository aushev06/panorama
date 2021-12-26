<?php

namespace App\Http\Requests\Options;

use App\Models\Option\OptionCategory;
use Illuminate\Foundation\Http\FormRequest;

class CategoryOptionRequest extends FormRequest
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
            implode('.', [OptionCategory::ATTR_NAME, 'required'])         => 'Заполните название',
            implode('.', [OptionCategory::ATTR_MAX_COUNT, 'required'])    => 'Укажите максимальное количество',
            implode('.', [OptionCategory::ATTR_STATUS, 'required'])       => 'Выберите статус',
            implode('.', [OptionCategory::ATTR_REQUIRED, 'required'])     => 'Выберите обязательна ли опция',
            implode('.', [OptionCategory::ATTR_MIN_SELECTED, 'required']) => 'Укажите минимальное количество выбираемых опций',
            implode('.', [OptionCategory::ATTR_MAX_SELECTED, 'required']) => 'Укажите максимальное количество выбираемых опций',

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
            OptionCategory::ATTR_NAME         => 'required',
            OptionCategory::ATTR_MAX_COUNT    => 'required',
            OptionCategory::ATTR_STATUS       => 'required',
            OptionCategory::ATTR_REQUIRED     => 'required',
            OptionCategory::ATTR_MIN_SELECTED => 'required',
            OptionCategory::ATTR_MAX_SELECTED => 'required',
        ];
    }
}
