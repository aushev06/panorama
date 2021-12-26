<?php

/**
 * @var \App\Models\Promotions\Promotions $model
 */
$info = null;
if( isset($model) && $model->info)
    $info = explode("\r\n", $model->info);
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
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Скидка</label>
            <input type="text" class="form-control" placeholder='Скидка' name="discount"
                   value="{{old('discount', $model->discount ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Описание</label>
            <textarea name="info" style="height:100px;" class="form-control"
                      placeholder="Описание">{{old('info', $model->info ?? '')}}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Статус активации</label>
            <select name="status" class="form-control">
                @foreach($statusVariants as $key => $status)
                    <option
                        @if(isset($model) && $model->status == $key) {{'selected'}} @endif value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>
        </div>
    </div>

{{--    <div class="col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label for="">Дата оконачания предложения</label>--}}
{{--            <input type="date" name="expired_at" class="form-control" value="{{old('expired_at', $model->expired_at ?? '')}}">--}}
{{--        </div>--}}
{{--    </div>--}}

</div>

