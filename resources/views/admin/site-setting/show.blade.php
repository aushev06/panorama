<?php

use App\Models\Food\Food;
use App\Http\Controllers\Admin\SettingController as Controller;
use App\Models\Ingridient\IngridientFoods;

/**
 * @var \App\Models\SiteSetting $model
 * @var Food $food
 */
?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route(Controller::ROUTE_INDEX)}}">{{Controller::TITLE}}</a>
                </li>

                <li class="breadcrumb-item active">{{$model->name}}</li>
            </ol>

            <!-- /cards -->
            <h2></h2>

            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-book"></i>{{$model->name}}</h2>
                    <div class="float-right">
                        <a href="{{route(Controller::ROUTE_EDIT, $model->id)}}" class="btn btn-info">Изменить</a>

                        <a class="btn btn-danger"
                           href="{{route(Controller::ROUTE_DESTROY, $model->id)}}" title="Удалить" aria-label="Удалить"
                           data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="delete"
                           data-redirect="{{route(Controller::ROUTE_INDEX)}}">Удалить</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Блюдо</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($model->foods as $food)
                        <tr>
                            <td>
                                {{$food->id}}
                            </td>
                            <td>
                                {{$food->name}}
                            </td>

                            <td>
                                @if(IngridientFoods::STATUS_ACTIVE === $food->pivot->status)
                                    <a href="{{route(Controller::ROUTE_UPDATE_STATUS, ['ingridientID' => $model->id, 'foodID' => $food->id])}}" title="Отключить"
                                       data-data='@json(['status' => IngridientFoods::STATUS_INACTIVE])'
                                       aria-label="Отключить"
                                       data-confirm="Вы уверены, что хотите отключить блюдо с этим ингридиентом?"
                                       data-method="PUT"
                                       data-redirect="{{route(Controller::ROUTE_SHOW, ['id' => $model->id])}}"><i
                                            class="fa fa-stop"></i></a>
                                @else
                                    <a href="{{route(Controller::ROUTE_UPDATE_STATUS, ['ingridientID' => $model->id, 'foodID' => $food->id])}}" title="Включить"
                                       data-data='@json(['status' => IngridientFoods::STATUS_ACTIVE])'
                                       aria-label="Включить"
                                       data-confirm="Вы уверены, что хотите включить блюдо с этим ингридиентом?"
                                       data-method="PUT"
                                       data-redirect="{{route(Controller::ROUTE_SHOW, ['id' => $model->id])}}"><i
                                            class="fa fa-play"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



