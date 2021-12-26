<!DOCTYPE html>
<html>

<head>
    <title>Магия - Доставка вкусной еды, доставка в Новофёдоровке</title>
    <meta charset="UTF-8">
    <title>Магия - Доставка вкусной еды, доставка в Новофёдоровке</title>

    <meta name="description" content="Заказать еду на дом в Новофёдоровке. Магия Доставка - быстрая доставка вкусной еды. Тел: +7 (978) 103 07 67 " />
    <meta name="keywords" content="магия, доставка,магия доставка,магия доставка еды,доставка еды новофедоровка,доставка еды саки,быстрая доставка,магия доставка,еда саки,еда новофёдоровка,доставка новофёдоровка,доставка саки" />

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="stylesheet" href="{{mix('frontend/css/all.css')}}">
    <link rel="shortcut icon" href="{{asset('frontend/images/logo.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div id="main">

    <header>
        <nav class="navigation d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-2"><a class="logo" href="/"><img src="{{asset('/images/logo-mobile.png')}}"
                                                                     alt=""
                                                                     style="width: 75%; margin-left: 40%"></a></div>
                    <div class="col-10">
                        <div class="navgition-menu d-flex align-items-center justify-content-center">
                            <ul class="mb-0">
                                <li class="toggleable">
                                    <a class="menu-item {{request()->is('/') ? 'active' : ''}}"
                                       href="/">Меню</a>
                                </li>
                                <li class="toggleable">
                                    <a class="menu-item {{request()->is('pay') ? 'active' : ''}}"
                                       href="/pay">Оплата</a>
                                </li>
                                <li class="toggleable">
                                    <a
                                        class="menu-item {{request()->is('delivery') ? 'active' : ''}}"
                                        href="/delivery">Доставка</a>
                                </li>
                                {{--<li class="toggleable">--}}
                                    {{--<a--}}
                                        {{--class="menu-item {{request()->is('bonus') ? 'active' : ''}}"--}}
                                        {{--href="{{route('bonus')}}">Бонусы</a>--}}
                                {{--</li>--}}
                                <li class="toggleable">
                                    <a class="menu-item {{request()->is('contact') ? 'active' : ''}}"
                                       href="/contact">Контакты</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="mobile-menu">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control"
                                                                                    href="#"><i class="fas fa-bars"
                                                                                                style="font-size: 1.8em;"></i></a>
                            <div id="ogami-mobile-menu">
                                <button class="no-round-btn" id="mobile-menu--closebtn" style="background-color: black !important;border: 2px solid black !important;">Закрыть</button>
                                <div class="mobile-menu_items">
                                    <ul class="mb-0 d-flex flex-column">
                                        <li class="toggleable"><a class="menu-item"
                                                                  href="/" ><img
                                                    src="{{asset('frontend/images/icon-menu/restaurant-menu.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Меню</a><span
                                                class="sub-menu--expander"></span>
                                            {{--<ul class="sub-menu">--}}
                                                {{--<li><a href="/">Категории</a></li>--}}
                                            {{--</ul>--}}
                                        </li>

                                        <li class="toggleable"><a class="menu-item"
                                                                  href="/pay"><img
                                                    src="{{asset('frontend/images/icon-menu/wallet.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Оплата</a>

                                        </li>
                                        <li class="toggleable"><a class="menu-item" href="/delivery"><img
                                                    src="{{asset('frontend/images/icon-menu/delivery.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Доставка</a>

                                        </li>
                                        {{--<li class="toggleable"><a class="menu-item" href="{{route('bonus')}}"><img--}}
                                                    {{--src="{{asset('frontend/images/icon/loyalty-card.png')}}"--}}
                                                    {{--style="width: 30px; margin-right: 5px;">Бонусы</a>--}}

                                        {{--</li>--}}
                                        <li class="toggleable"><a class="menu-item" href="/contact"><img
                                                    src="{{asset('frontend/images/icon-menu/address.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Контакты</a>

                                        </li>
                                    </ul>
                                </div>
                                <!--
                                @guest
                                <div class="mobile-login">
                                    <h2>Личный кабинет</h2><a href={{route('login')}}><img
                                            src="{{asset('frontend/images/icon/gender-neutral-user.png')}}"
                                            style="width: 30px; margin-right: 5px;">Вход</a><a
                                        href="{{route('register')}}"><img
                                            src="{{asset('frontend/images/icon/add-user-male.png')}}"
                                            style="width: 30px; margin-right: 5px;">Регистрация</a>
                                </div>
                                @else

                                    <div class="mobile-login">
                                        <h2>Личный кабинет</h2>

                                        <a href="#"><i class="fas fa-user" style="width: 30px; margin-right: 5px;"></i>Главная</a>
                                        <a  href="#"><i class="fas fa-edit"style="width: 30px; margin-right: 5px;"></i>Настройки</a>
                                        <a  href="#"><i class="fas fa-sign-out-alt" style="width: 30px; margin-right: 5px;"></i>Выход</a>
                                    </div>

                                 @endguest
                                -->
                                {{--<div class="mobile-social"><a href="https://vk.com/club136274972" target="_blank"><img--}}
                                            {{--src="{{asset('frontend/images/icon/vk-com.png')}}"--}}
                                            {{--style="width: 40px; margin-right: 5px;"></a><a--}}
                                        {{--href="https://www.facebook.com/jrooburgersteak/" target="_blank"><img--}}
                                            {{--src="{{asset('frontend/images/icon/facebook-new.png')}}"--}}
                                            {{--style="width: 40px; margin-right: 5px;"></a><a--}}
                                        {{--href="https://www.instagram.com/jroo_burger_steak/" target="_blank"><img--}}
                                            {{--src="{{asset('frontend/images/icon/instagram.png')}}"--}}
                                            {{--style="width: 40px; margin-right: 5px;"></a>--}}
                                {{--</div>--}}


                                <div class="mobile-login" style="margin-top: 15px;">

                                    <a href="https://yandex.ru/maps/-/CGsruQ9e">
                                        <p class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
                                            Адрес: пгт. Новофедоровка, ул. Приморская, 7
                                        </p>
                                    </a>
                                    <a href="">
                                        <p class="d-flex align-items-center">
                                            <i class="fas fa-phone" style="margin-right: 10px;"></i><a
                                                href="tel:+79781030767" style="color: #0b0b0b"> +7 (978) 103 07 67</a>
                                        </p>
                                    </a>
                                    <a href="">
                                        <p class="d-flex align-items-center">
                                            <i class="far fa-clock"
                                               style="margin-right: 10px;"></i>
                                            Будние дни 10:00 – 00:00<br>
                                            Выходные дни 10:00 – 01:00
                                        </p>
                                    </a>

                                </div>
                            </div>
                            <div class="ogamin-mobile-menu_bg"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center">
                            <a href="/"><img src="{{asset('/images/logo-mobile.png')}}" style="width: 90%"
                                             alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

@yield('content')
<!-- End header-->
{{--    @include('components.partners')--}}

</div>
<!-- End partner-->
{{--<footer>--}}
    {{--<div class="footer-credit" style="background-color: gray;">--}}
        {{--<div class="container">--}}
            {{--<div--}}
                {{--class="text-center">--}}
                {{--<p class="author">Copyright © 2019 Магия</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</footer>--}}
<!-- End footer-->
</div>
<script defer src="{{mix('frontend/js/all.js')}}"></script>

<script src="{{ asset('admin_assets/js/custom.js')}}"></script>
{!!  GoogleReCaptchaV3::init() !!}

</body>
</html>
