<?php
/**
 * @var App\Models\Option\Option $model
 */

$model = $model ?? new \App\Models\Option\Option();
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Введите название</label>
            <input type="text" name="name" class="form-control" placeholder="Введите название"
                   value="{{old('name', $model->name ?? '')}}">
        </div>

        <div class="form-group">
            <label>Цена</label>
            <input type="number" name="price" class="form-control" placeholder="Введите цену"
                   value="{{old('price', $model->price ?? "")}}">
        </div>

        <div class="form-group">
            <label>Максимум</label>
            <input type="number" name="multiplier" class="form-control" placeholder="Введите максимальное количество"
                   value="{{old('multiplier', $model->multiplier ?? "")}}">
        </div>

        <div class="form-group">
            <label>Статус</label>
            <select name="status" class="form-control">
                @foreach(\App\Models\Option\Option::getStatusVariants() as $key => $status)
                    <option value="{{$key}}" {{$key === $model->status ? 'selected' : ''}}>{{$status}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Категория</label>
            <select name="{{$model::ATTR_OPTION_CATEGORY_ID}}" class="form-control">
                @foreach(\App\Models\Option\OptionCategory::get() as $category)
                    <option
                        {{$model->option_category_id === $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>

