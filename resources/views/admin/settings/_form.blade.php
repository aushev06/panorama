<?php

/**
 * @var \App\Models\Settings $model
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
            <label for="">Ключ</label>
            <input type="text" name="{{$model::ATTR_KEY}}" class="form-control" placeholder="Ключ"
                   value="{{old($model::ATTR_KEY, $model->key ?? '')}}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="">Значение</label>
            <input type="text" name="{{$model::ATTR_VALUE}}" class="form-control" placeholder="Значение"
                   value="{{old($model::ATTR_VALUE, $model->value ?? '')}}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="">Статус</label>
            <select name="{{$model::ATTR_STATUS}}" class="form-control">
                @foreach($model::getStatusVariants() as $key => $statusVariant)
                    <option
                        value="{{$key}}" {{isset($model) && $model->status === (int)$key ? 'selected' : ''}} >{{$statusVariant}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="">Описание</label>
            <input type="text" name="{{$model::ATTR_DESCRIPTION}}" class="form-control" placeholder="Описание"
                   value="{{old($model::ATTR_DESCRIPTION, $model->description ?? '')}}">
        </div>
    </div>



</div>

