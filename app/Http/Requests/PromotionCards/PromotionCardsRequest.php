<?php

namespace App\Http\Requests\PromotionCards;

use Illuminate\Foundation\Http\FormRequest;

class PromotionCardsRequest extends FormRequest
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
            'img.required'     => 'Необходимо выбрать картинку',
            'img.mimes'        => 'Картинка должна быть формата png',
            'img.max'          => 'Размер файла не может быть больше 400 Килобайт(а)',
            'img.dimensions'   => 'Доступная высота картинки 500-550 пискелей, а ширина 1500-1650 пикселей',
            'img-url.required' => 'Необходимо выбрать картинку',
            'name.required'    => 'Заполните название',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['name' => 'required'];

        $defaultImg = 'admin_assets/img/no_image.png';
        if (!$_POST['img-src']) {
            $rules[] = ['img' => 'required|mimes:png|max:400|dimensions:min_width=1500,min_height=500,max_width=1650,max_height=550'];
        }

        if (strpos($_POST['img-src'], $defaultImg)) {
            return ['img-url' => 'required'];
        }

        return $rules;
    }
}
