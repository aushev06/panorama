<?php
/**
 * @var Food $model
 */

use App\Http\Controllers\Admin\FoodController as Controller;

?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="box_general padding_bottom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route(Controller::ROUTE_INDEX)}}">{{Controller::TITLE}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route(Controller::ROUTE_INDEX) . '?category=' . $model->category_id}}">{{$model->category->name}}</a>
                </li>

                <li class="breadcrumb-item active">{{$model->name}}</li>
            </ol>
            <div class="header_box version_2">
                <h2><i class="fa fa-cutlery" aria-hidden="true"></i>Редактирование блюда</h2>
            </div>


            <form action="{{route(Controller::ROUTE_UPDATE, $model->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                @include('admin.food._form', [
                    'categories' => $categories,
                    'variants' => $variants,
                    'model' => $model,
                    'foodProperties' => $foodProperties,
                    'foods' => $foods,
                    'options' => $options,
                ])
                <button class="btn btn-success">Сохранить</button>
            </form>
        </div>


    </div>
@endsection
