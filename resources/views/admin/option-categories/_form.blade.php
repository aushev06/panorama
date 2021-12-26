<?php
/**
 * @var \App\Models\Option\OptionCategory $model
 */

$model = $model ?? new \App\Models\Option\OptionCategory();
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
            <label>Максимальное количество</label>
            <input type="number" value="{{$model->max_count}}" name="max_count" class="form-control"
                   placeholder="Введите максимальное возможное количество">
        </div>

        <div class="form-group">
            <label>Максимальное возможное количество выбранных опций</label>
            <input type="number" value="{{$model->max_selected}}" name="max_selected" class="form-control"
                   placeholder="Введите максимальное возможное количество выбранных опций">
        </div>

        <div class="form-group">
            <label>Минимальное возможное количество выбранных опций</label>
            <input type="number" value="{{$model->min_selected}}" name="min_selected" class="form-control"
                   placeholder="Введите минимальное возможное количество выбранных опций">
        </div>


        <div class="form-group">
            <select name="status" class="form-control" value="{{$model->status}}">
                @foreach(\App\Models\Option\OptionCategory::getStatusVariants() as $key => $status)
                    <option {{$key === $model->status ? 'selected': ''}} value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <strong>Обязательно</strong>
            <select name="required" class="form-control" value="{{$model->required}}">
                @foreach(\App\Models\Option\OptionCategory::getRequiredVariants() as $key => $variant)
                    <option {{$key === $model->required ? 'selected': ''}} value="{{$key}}">{{$variant}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
