@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Доска</a>
                </li>
            </ol>

            <!-- /cards -->
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-bar-chart"></i>Моя доска</h2>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-sm-6 mb-3">
                        <div class="card dashboard text-white bg-primary o-hidden h-100">
                            <a
                                href="{{route('food.index')}}">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fa fa-cutlery"></i>
                                    </div>
                                    <div class="mr-5">
                                        <h5>Блюда</h5>
                                    </div>
                                </div>
                            </a>
                            <a class="card-footer text-white clearfix small z-1"
                               href="{{route('food.index')}}">
                                <span class="float-left">Перейти</span>
                                <span class="float-right">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 mb-3">
                        <div class="card dashboard text-white bg-info o-hidden h-100">
                            <a
                                href="{{route('order.index')}}">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-5">
                                        <h5>Заказы</h5>
                                    </div>
                                </div>
                            </a>
                            <a class="card-footer text-white clearfix small z-1"
                               href="{{route('order.index')}}">
                                <span class="float-left">Перейти</span>
                                <span class="float-right">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



