@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                \App\Widgets\Breadcumb\models\Breadcumb::create('Авторизация', '#'),
            ]])
    }}
    <div class="account">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
                    <h1 class="title">Вход в личный кабинет</h1>

                    @error('message')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user-name">Номер или email address *</label>
                            <input class="no-round-input" name="login" id="user-name" type="text">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль *</label>
                            <input class="no-round-input" name="password" id="password" type="password">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="account-method">
                                <div class="account-save">
                                    <input id="savepass" name="remember" type="checkbox">
                                    <label for="savepass">Запомнить</label>
                                </div>
                                <div class="account-forgot"><a href="#">Забыли пароль?</a></div>
                            </div>
                        </div>

                        <div class="account-function">
                            <button class="no-round-btn">Войти</button>
                            <a class="create-account" href="{{route('register')}}">Создать личный кабинет</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
