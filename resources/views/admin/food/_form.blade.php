<?php

use App\Models\Food\models\FoodViewModel;

/**
 * @var FoodViewModel|null $model
 */
?>
<div class="row">

    <div class="col-md-12">
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Выбрать фото</label>
            <input id="input-b1" name="img" type="file" class="file" data-browse-on-zone-click="true">
        </div>
    </div>
    <div class="col-md-8 add_top_30">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control" placeholder="Название"
                           value="{{old('name', $model->name ?? '')}}"
                           name="name">
                </div>
            </div>
        </div>
        <!-- /row-->

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Категория</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}" {{isset($model) && $model->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Статус</label>
                    <select name="status" class="form-control">
                        @foreach($variants as $key => $statusVariant)
                            <option
                                value="{{$key}}" {{isset($model) && $model->status == $statusVariant ? 'selected' : ''}} >{{$statusVariant}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Описание</label>
                    <textarea name="description" style="height:100px;" class="form-control"
                              placeholder="Описание">{{old('description', $model->description ?? '')}}</textarea>
                </div>
            </div>
        </div>
        <!-- /row-->

        <div class="row">
            <div class="col-2">
                <div class="form-group field-dishes-title required">

                    <label class="control-label" for="weight">Вес</label>

                    <input type="text" class="form-control" name="FoodInfo[weight]"
                           value="{{old('weight', $model->foodInfo->weight ?? '')}}">

                    <div class="help-block"></div>

                </div>
            </div>
            <div class="col-2">
                <div class="form-group field-dishes-title required">

                    <label class="control-label" for="dishes-title" name="FoodInfo[carbohydrates]">Углеводы</label>

                    <input type="text" class="form-control" name="FoodInfo[carbohydrates]"
                           value="{{old('FoodInfo[carbohydrates]', $model->foodInfo->carbohydrates ?? '')}}">

                    <div class="help-block"></div>

                </div>
            </div>
            <div class="col-2">
                <div class="form-group field-dishes-title required">

                    <label class="control-label">Белки</label>

                    <input type="text" class="form-control" name="FoodInfo[protein]"
                           value="{{old('FoodInfo[protein]', $model->foodInfo->protein ?? '')}}">

                    <div class="help-block"></div>

                </div>
            </div>
            <div class="col-2">
                <div class="form-group field-dishes-title required">

                    <label class="control-label">Жиры</label>

                    <input type="text" class="form-control" name="FoodInfo[fat]"
                           value="{{old('FoodInfo[fat]', $model->foodInfo->fat ?? '')}}">

                    <div class="help-block"></div>

                </div>
            </div>

            <div class="col-2">
                <div class="form-group field-dishes-title required">

                    <label class="control-label">Калории</label>

                    <input type="text" class="form-control" name="FoodInfo[calories]"
                           value="{{old('FoodInfo[calories]', $model->foodInfo->calories ?? '')}}">

                    <div class="help-block"></div>

                </div>
            </div>

        </div>
    </div>


{{--    <div class="col-md-12">--}}
{{--        <div class="form-group">--}}
{{--            <label>Дополнительные изображения</label>--}}
{{--            <input id="input-b1" name="imgs[]" type="file" multiple class="file" data-browse-on-zone-click="true">--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="col-md-12">
        <div id="react-add-variants" data-foods='@json($foodProperties ?? [])'></div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <strong for="recomend">Выберите рекомендуемые блюда</strong>
            <select id="recomend" name="recomendID[]" class="form-control foods" multiple>
                @foreach($foods as $food)
                    <option
                        value="{{$food['id']}}" {{true === $food['select'] ? "selected" : ''}} >{{$food['name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <strong>Выберите дополнительные опции</strong>
            <select name="options[]" class="form-control options" multiple>
                @foreach($options as $option)
                    <option
                        {{true === $option['select'] ? 'selected' : ''}} value="{{$option['id']}}">{{$option['name']}}</option>
                @endforeach
            </select>
        </div>

    </div>

</div>

