<?php
/**
 * @var \App\Models\Category\Category $model
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
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Введите название</label>
            <input type="text" name="name" class="form-control" placeholder="Введите название"
                   value="{{old('name', $category->name ?? '')}}">
        </div>

        <div class="form-group">
            <label>Статус</label>
            <select name="status" class="form-control">
                @foreach(\App\Models\Category\Category::getStatusVariants() as $key => $statusVariant)
                    <option
                        value="{{$key}}" {{isset($model) && $model->status == $statusVariant ? 'selected' : ''}} >{{$statusVariant}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Выберите изображение</label>
            <input id="input-b1" name="img" type="file" class="file" data-browse-on-zone-click="true">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Выберите иконку</label>
            <input id="input-b1" name="icon" type="file" class="file" data-browse-on-zone-click="true">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Описание</label>
            <textarea rows="5" name="description" class="form-control" id="editor"
                      placeholder="Описание">{{old('description', $category->description ?? '')}}</textarea>
        </div>
    </div>
</div>
