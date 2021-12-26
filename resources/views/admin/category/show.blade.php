<?php
/**
 * @var \App\Models\Category\Category $category
 */

?>

@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('categories.index')}}">Категории</a>
                </li>

                <li class="breadcrumb-item active">{{$category->name}}</li>
            </ol>

            <!-- /cards -->
            <h2></h2>

            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-book"></i>Детали категории</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Изображение</label>
                            <div>
                                <img src="{{$category->img}}" alt="" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <table class="table">
                            <tr>
                                <th>Название</th>
                                <td>{{$category->name}}</td>
                            </tr>
                            <tr>
                                <th>Описание</th>
                                <td>
                                    {{$category->description}}
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



