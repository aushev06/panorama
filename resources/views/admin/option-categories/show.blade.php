<?php
/**
 * @var \App\Models\Option\OptionCategory $category
 */

?>

@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('option-categories.index')}}">Категории</a>
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
                    <div class="col-md-12 add_top_30">
                        <table class="table">
                            <tr>
                                <th>Название</th>
                                <td>{{$category->name}}</td>
                            </tr>
                            <tr>
                                <th>Максимальное количество:</th>
                                <td>
                                    {{$category->max_count}}
                                </td>
                            </tr>

                            <tr>
                                <th>Максимальное возможное количество опций:</th>
                                <td>
                                    {{$category->max_selected}}
                                </td>
                            </tr>

                            <tr>
                                <th>Минимальное возможное количество опций:</th>
                                <td>
                                    {{$category->min_selected}}
                                </td>
                            </tr>

                            <tr>
                                <th>Required:</th>
                                <td>
                                    {{$category->required === $category::REQUIRED_ACTIVE ? 'Required' : 'No'}}
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



