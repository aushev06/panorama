<?php
/**
 * @var \App\User $model
 */

$model = auth()->user();
?>

@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                \App\Widgets\Breadcumb\models\Breadcumb::create('Личный кабинет', '#'),
            ]])
    }}

    <div class="account">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" style="font-size: 2em;" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><img src="{{asset('frontend/images/icon/contact-card.png')}}" style="width: 10%; margin-right: 10px;">Личные данные</a>
                        <a class="list-group-item list-group-item-action" style="font-size: 2em;" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><img src="{{asset('frontend/images/icon/time-machine.png')}}" style="width: 10%; margin-right: 10px;">История заказов</a>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 mx-auto">
                                    <h1 class="title text-center" style="font-size: 24px">Личный кабинет</h1>

                                    <div class="mt-2">
                                        @if ($errors->any())

                                            <div class="alert alert-danger">

                                                <ul>

                                                    @foreach ($errors->all() as $error)

                                                        <li>{{ $error }}</li>

                                                    @endforeach

                                                </ul>

                                            </div>

                                        @endif
                                    </div>

                                    <form method="POST" action="{{ route('client') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                                       value="{{ old('name', $model->name) }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Номер телефона') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text"
                                                       class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                       value="{{ old('phone', $model->phone) }}" required autocomplete="phone">

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ old('email', $model->email) }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="birthday"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

                                            <div class="col-md-6">
                                                <input id="birthday" type="date"
                                                       class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                                       value="{{ old('birthday', $model->birthday) }}">

                                                @error('birthday')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Адрес') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="form-control @error('address') is-invalid @enderror" name="address"
                                                       value="{{ old('address', $model->address) }}">

                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group d-flex mb-0 justify-content-center align-items-center">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    {{ __('Сохранить') }}
                                                </button>
                                            </div>

                                            <div class="ml-1">
                                                <a class="btn btn-danger" onclick="$('#logout').submit()">Выйти</a>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="">
                                <h2 class="title text-center" style="font-size: 24px">Мои заказы</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Сумма</th>
                                        <th>Дата заказа</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{$order->date_delivery}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
{{--        <form id="logout" method="post" action="{{route('logout')}}">--}}
        <form id="logout" method="post" action="/logout">
            @csrf
        </form>
    </div>
@endsection
