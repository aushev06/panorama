<?php
/**
 * @var Food $model
 */

use App\Http\Controllers\Admin\OrderController as Controller;

?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-cutlery" aria-hidden="true"></i>Изменение заказа</h2>
            </div>


            <form action="{{route(Controller::ROUTE_UPDATE, $model->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                @include('admin.order._form', [
                    'model' => $model,
                ])
                <button class="btn btn-success">Сохранить</button>
            </form>
        </div>


    </div>
@endsection
