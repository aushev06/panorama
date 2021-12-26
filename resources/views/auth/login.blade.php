@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                \App\Widgets\Breadcumb\models\Breadcumb::create('Авторизация', '#'),
            ]])
    }}
    <div class="account">
        <div class="container">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
                    <h1 class="title">Вход в личный кабинет</h1>


                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user-name">Номер или Email-адрес *</label>
                            <input class="no-round-input" name="login" id="user-name" type="text">
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль *</label>
                            <input class="no-round-input" name="password" id="password" type="password">
                        </div>

                        <div class="account-function">
                            <button class="no-round-btn" style="background: #000000;">Войти</button>
                            <a class="create-account" href="{{url('password/reset')}}">Восстановить пароль</a><br><br>
                            <a class="create-account" href="{{route('register')}}">Создать личный кабинет</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
