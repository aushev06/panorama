<?php

use App\Http\Controllers\Admin\IngridientController as Controller;

?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-cutlery" aria-hidden="true"></i>Редактирование ингридиента</h2>
            </div>
            <form action="{{route(Controller::ROUTE_UPDATE, $model->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @component('admin.ingridient._form', ['model' => $model, 'foods' => $foods])@endcomponent
                <button class="btn btn-success">Изменить</button>
            </form>
        </div>


    </div>
@endsection
