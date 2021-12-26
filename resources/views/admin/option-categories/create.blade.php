@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- /cards -->
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Добавить категорию</h2>
                </div>
                <form method="post" action="{{route('option-categories.store')}}" class="create-form"
                      enctype="multipart/form-data">
                    @csrf
                    @include('admin.option-categories._form')
                    <button class="btn badge-primary" type="submit">Добавить</button>
                </form>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



