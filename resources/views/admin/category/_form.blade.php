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
            <label>Связь с категорией</label>

            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Главная</option>
                @foreach ($categories as $cat)
                    @include('admin.category.form.options', [
                        'category' => $category ?? [],
                        'categories' => $cat,
                        'name' => ''
                    ])
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Введите название</label>
            <input type="text" name="name" class="form-control" placeholder="Введите название"
                   value="{{old('name', $category->name ?? '')}}">
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
            <label>Видимость категории</label>
            <select class="form-control" id="status" name="status">
                <option value="0" <?= $category->status === 0 ? 'selected' : ''?> >Скрытая</option>
                <option value="1" <?= $category->status === 1 ? 'selected' : ''?> >Видимая</option>
            </select>
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
