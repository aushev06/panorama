<?php
/**
 * @var \App\Models\Option\Option $option
 */
?>
@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

        @endif
        <!-- /cards -->
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Изменить</h2>
                </div>
                <form method="post" action="{{route('options.update', $option->id)}}" class="create-form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.options._form', ['model' => $option])
                    <button class="btn badge-primary" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



