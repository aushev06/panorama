<?php
/**
 * @var \App\Models\Coupon\Coupon[] $coupons
 */

use App\Http\Controllers\Admin\CouponController as Controller;

?>

@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.index')}}">Доска</a>
                </li>
                <li class="breadcrumb-item active">{{Controller::TITLE}}</li>
            </ol>

            <!-- /cards -->
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-fw fa-list"></i>{{Controller::TITLE}}</h2>
                    <div class="pull-right">
                        <a href="{{route(Controller::ROUTE_CREATE)}}" class="btn badge-primary">Добавить</a>
                    </div>
                </div>

                <div class="categories">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>Купон</th>
                            <th>Действие</th>
                        </tr>

                        @foreach($coupons as $model)
                            <tr>
                                <td>
                                    {{$model->id}}
                                </td>
                                <td>
                                    {{$model->coupon}}
                                </td>
                                <td>
                                    <a href="{{route(Controller::ROUTE_SHOW, $model->id)}}"><i
                                            class="fa fa-fw fa-eye"></i></a>

                                    <a href="{{route(Controller::ROUTE_EDIT, $model->id)}}"><i
                                            class="fa fa-fw fa-edit"></i></a>

                                    <a href="{{route(Controller::ROUTE_DESTROY, $model->id)}}" title="Удалить"
                                       aria-label="Удалить"
                                       data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="delete"
                                       data-redirect="{{route(Controller::ROUTE_INDEX)}}"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



