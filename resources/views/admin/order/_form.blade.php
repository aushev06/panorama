<?php

/**
 * @var \App\Models\Order\models\OrderViewModel $model
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
            <label for="name">Имя</label>
            <input id="name" type="text" class="form-control" placeholder="Имя" name="name" value="{{old('name', $model->name ?? '')}}">
        </div>
    </div>


</div>

