@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.index')}}">Доска</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
        </ol>

        <!-- /cards -->
        <h2></h2>
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-bar-chart"></i>Statistic</h2>
            </div>

        </div>
    </div>
    <!-- /.container-fluid-->
</div>
@endsection



