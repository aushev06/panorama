<?php
/**
 * @var \App\Models\Ingridient\Ingridient $ingridients []
 */

use App\Http\Controllers\Admin\IngridientController as Controller;

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
                <li class="breadcrumb-item active">Стоп-лист</li>
            </ol>

            <!-- /cards -->
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-fw fa-list"></i>Стоп-лист</h2>
                    <div class="pull-right">
                        <a href="{{route(Controller::ROUTE_CREATE)}}" class="btn badge-primary">Добавить</a>
                    </div>
                </div>

                <div class="categories">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Статус</th>
                        </tr>

                        <tr>
                            <form action="{{route(Controller::ROUTE_INDEX)}}" method="get">
                                <th>
                                    <input type="number" class="form-control" name="id">
                                </th>
                                <th>
                                    <input type="text" class="form-control" name="name">
                                </th>
                                <th>
                                    <input type="status" class="form-control" name="status">
                                </th>
                            </form>
                        </tr>

                        @foreach($ingridients as $model)
                            <tr>
                                <td>
                                    {{$model->id}}
                                </td>
                                <td>
                                    {{$model->name}}
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
                {{$ingridients->links()}}
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



