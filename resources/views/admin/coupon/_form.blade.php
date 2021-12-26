<?php

/**
 * @var \App\Models\Coupon\Coupon $model
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
            <label for="">Купон</label>
            <input type="text" name="coupon" class="form-control" placeholder="Купон"
                   value="{{old('coupon', $model->coupon ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Количество активаций</label>
            <input type="text" class="form-control" placeholder='Количество возможных активаций' name="quantity"
                   value="{{old('quantity', $model->quantity ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Тип скидки купона</label>
            <select name="type" class="form-control">
                @foreach($typeVariants as $key => $variant)
                    <option value="{{$key}}">{{$variant}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Значение</label>
            <input type="text" class="form-control" placeholder="Сумма или процент скидки" name="value"
                   value="{{old('value', $model->value ?? '')}}">
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="">Статус активации</label>
            <select name="status" class="form-control">
                @foreach($statusVariants as $key => $status)
                    <option
                        @if(isset($model) && $model->status == $status) {{'selected'}} @endif value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="">Дата оконачания купона</label>
            <input type="date" name="expired_at" class="form-control" value="{{old('expired_at', $model->expired_at ?? '')}}">
        </div>
    </div>


</div>

