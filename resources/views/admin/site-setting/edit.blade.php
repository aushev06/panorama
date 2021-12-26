<?php

use App\Http\Controllers\Admin\SiteSettingController as Controller;

?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-cutlery" aria-hidden="true"></i>Редактирование настройки</h2>
            </div>
            <form action="{{route(Controller::ROUTE_UPDATE, $model->key)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @component('admin.site-setting._form', ['model' => $model])@endcomponent
                <button class="btn btn-success">Изменить</button>
            </form>
        </div>


    </div>
@endsection
