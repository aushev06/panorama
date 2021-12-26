<?php

/**
 * @var \App\Models\PromotionCards\PromotionCards $model
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

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Наименование</label>
            <input type="text" name="name" class="form-control" placeholder="Наименование"
                   value="{{old('name', $model->name ?? '')}}">
        </div>

        <div class="form-group">
            <img style="width: 100%; margin-bottom: 1em" id="img-input"/>
            <input type="text" id="img-src" name="img-src" hidden value="{{old('img', $model->img ?? '')}}">
            <div class="form-group">
                <label>Выбрать фото &nbsp;</label>
                <input id="input-img" name="img" type="file" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Ссылка</label>
            <input type="text" class="form-control" placeholder='Ссылка' name="url"
                   value="{{old('url', $model->url ?? '')}}">
        </div>

        <div class="form-group">
            <label for="">Позиция</label>
            <input type="number" name="position" class="form-control" placeholder="Позиция"
                   value="{{old('position', $model->position ?? 0)}}" min="0" max="50">
        </div>

        <div class="form-group">
            <label for="">Статус активации</label>
            <select name="status" class="form-control">
                @foreach($model::getStatusesVariants() as $key => $status)
                    <option value="{{$key}}" {{$key === $model->status ? 'selected' : ''}}>{{$status}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">

    </div>

    <script>
        const changeFile = (e) => {
            const fileImg = e.target.files[0];
            let url = '';
            if(fileImg) {
                url = URL.createObjectURL(fileImg);
            }

            document.querySelector('img#img-input').src = url;
            document.querySelector('#img-src').value = url;
        };

        const inputImg = document.getElementById('input-img');
        inputImg.addEventListener('change', changeFile);

        const img = '{{$model->img ?: null}}';
        document.addEventListener('DOMContentLoaded', () => {
            const image = $('img#img-input')[0];
            image.src = img;
        })
    </script>
</div>

