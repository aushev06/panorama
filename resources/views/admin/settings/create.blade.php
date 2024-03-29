<?php

use App\Http\Controllers\Admin\SettingsController as Controller;

?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-cutlery" aria-hidden="true"></i>Добавление настройки</h2>
            </div>
            <form action="{{route(Controller::ROUTE_STORE)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @component('admin.settings._form', ['model' => $model])@endcomponent
                <button class="btn btn-success">Создать</button>
            </form>
        </div>


    </div>
@endsection
