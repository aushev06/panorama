<?php

/**
 * @var \App\Models\Ingridient\Ingridient $model
 * @var \App\Models\Category\Category $foods []
 * @var \App\Models\Food\Food $food
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

    <div class="col-md-12">
        <div class="form-group">
            <label for="">Ингридиент</label>
            <input type="text" name="{{$model::ATTR_NAME}}" class="form-control" placeholder="Ингридиент"
                   value="{{old($model::ATTR_NAME, $model->name ?? '')}}">
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label for="">Статус</label>
            <select name="{{$model::ATTR_STATUS}}" class="form-control">
                @foreach($model::getStatusVariants() as $key => $status)
                    <option
                        @if($model->status == $status) {{'selected'}} @endif value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <select class="foods form-control" name="foods[]" multiple>
                @foreach($foods as $foodCategory)
                    <optgroup label="{{$foodCategory['name']}}">
                        @foreach($foodCategory['foods'] as $food)
                            <option value="{{$food['id']}}" {{true === $food['selected'] ? 'selected': ''}}>{{$food['name']}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
    </div>


</div>

