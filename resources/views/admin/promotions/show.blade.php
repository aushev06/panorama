<?php

use App\Models\Promotions\Promotions;
use App\Http\Controllers\Admin\PromotionsController as Controller;

/**
 * @var Promotions $model
 */
?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
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
                    <h2><i class="fa fa-book"></i>Детали</h2>
                    <div class="float-right">
                        <a href="{{route(Controller::ROUTE_EDIT, $model->id)}}" class="btn btn-info">Изменить</a>

                        <a class="btn btn-danger"
                           href="{{route(Controller::ROUTE_DESTROY, $model->id)}}" title="Удалить" aria-label="Удалить"
                           data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="delete"
                           data-redirect="{{route(Controller::ROUTE_INDEX)}}">Удалить</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 add_top_30">
                        <table class="table">
                            <tr>
                                <th>Название</th>
                                <td>{{$model->name}}</td>
                            </tr>
                            <tr>
                                <th>Описание</th>
                                <td>
                                    {{$model->info}}
                                </td>
                            </tr>

                            <tr>
                                <th>Скидка</th>
                                <td>
                                    {{$model->discount}}
                                </td>
                            </tr>

                            <tr>
                                <th>Статус</th>
                                <td>
                                    <span class="badge badge-primary">{{$model->status}}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



