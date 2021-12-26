<?php
/**
 * @var \App\Models\Coupon\Coupon[] $coupons
 */

use App\Http\Controllers\Admin\OrderController as Controller;

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
                </div>

                <div class="list_general">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Сумма</th>
                                <th>Дата</th>
                                <th>Фильтр</th>
                            </tr>
                            <tr>
                                <form action="{{route(Controller::ROUTE_INDEX)}}" method="get">
                                    <td>
                                        <input type="text" class="form-control" name="name" value="{{request('name')}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="total" value="{{request('total')}}">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="date" value="{{request('date')}}">
                                    </td>
                                    <td>
                                        <button class="btn badge-primary">Применить</button>
                                    </td>
                                </form>
                            </tr>
                        </thead>
                    </table>

                    <ul>
                        @foreach($orders as $order)
                            @component('admin.order.components.cardOrder', ['model' => $order])@endcomponent
                        @endforeach

                    </ul>

                </div>

                <div class="mt-2">
                    {{$orders->links()}}
                </div>

            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



