<?php
/**
 * @var \App\Models\Option\Option $option
 */

?>

@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('options.index')}}">Опции</a>
                </li>

                <li class="breadcrumb-item active">{{$option->name}}</li>
            </ol>

            <!-- /cards -->
            <h2></h2>

            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-book"></i>Детали</h2>
                </div>
                <div class="row">
                    <div class="col-md-12 add_top_30">
                        <table class="table">
                            <tr>
                                <th>Название</th>
                                <td>{{$option->name}}</td>
                            </tr>
                            <tr>
                                <th>Цена</th>
                                <td>
                                    {{$option->price}}
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



