<?php
use App\Models\Settings;
$settings = new Settings();
$activeSettings = $settings->getActiveSettings();
$weekdaysStart = $settings->getWeekdaysOpen($activeSettings);
$weekdaysEnd   = $settings->getWeekdaysClose($activeSettings);
$weekendStart  = $settings->getWeekendOpen($activeSettings);
$weekendEnd    = $settings->getWeekendClose($activeSettings);
?>
<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', "Панорама - Доставка еды")</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="stylesheet" href="{{mix('frontend/css/all.css')}}">
    <link rel="shortcut icon" href="{{asset('frontend/images/logo3.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div id="main">

    <header>
        {{--<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
            {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                {{--<div class="modal-content">--}}
                    {{--<div class="modal-header" style="background: #2C150C;">--}}
                    {{--</div>--}}
                    {{--<div class="modal-body text-center">--}}
                        {{--<img src="{{asset('frontend/images/logo3.png')}}" alt="Доставка вкусных бургеров JROO"  title="Доставка вкусных бургеров JROO" style="width: 18em; margin-right: 20px;">--}}
                        {{--<h3 style="font-weight: bold; font-size: 25pt;">Мы на карантине!</h3>--}}
                        {{--<h4 style="font-weight: bold; color:#F8AE33; font-size: 20pt;">--}}
                            {{--Следите за нами в социальных сетях по хэштегу <a href="https://www.instagram.com/jroo_burger_steak/" target="_blank" style="color: #2C150C;">#jrooyalta</a> и узнаете первыми!</h4>--}}

                    {{--</div>--}}
                    {{--<div class="modal-footer text-center" style="background: #2C150C;; display: block !important;">--}}
                        {{--<a href="https://www.instagram.com/jroo_burger_steak/" target="_blank" class="text-center"><i class="fab fa-instagram" style="color: white; font-size: 3.5em;"></i></a>--}}
                        {{--<a href="https://vk.com/club136274972" target="_blank" class="text-center"><i class="fab fa-vk" style="color: white; font-size: 3.5em;"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="header-block d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="header-left d-flex flex-column flex-md-row align-items-center">
                            <p class="d-flex align-items-center"><img
                                    src="{{asset('frontend/images/icon/map-marker.png')}}" style="width: 3em"><a
                                    href="https://yandex.ru/maps/-/CGsruQ9e" style="color: black;">г. Магас
                                    Проспект Зязикова, 2A
                                    На крыше бизнес-отеля Магас</a></p>
                            <p class="d-flex align-items-center"><img
                                    src="{{asset('frontend/images/icon/phone.png')}}" style="width: 3em"><a
                                    href="tel:+79287328477" style="color: #0b0b0b">  +7 (928) 732-84-77</a>
                            </p>
                            <p class="d-flex align-items-center"><img
                                    src="{{asset('frontend/images/icon/time-machine.png')}}" style="width: 3em">Пн-пт с
                                {{$weekdaysStart}} до {{$weekdaysEnd}}
                                <br>
                                Сб-вс с {{$weekendStart}} до {{$weekendEnd}} </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div
                            class="header-right d-flex justify-content-around">
                            <div class="social-link d-flex">
                                <a href="https://vk.com/club136274972" target="_blank"><img
                                        src="{{asset('frontend/images/icon/vk-com.png')}}" style="width: 3em"> </a>
                                <a href="https://www.facebook.com/jrooburgersteak/" target="_blank"><img
                                        src="{{asset('frontend/images/icon/facebook-new.png')}}" style="width: 3em"></a>
                                <a href="https://www.instagram.com/jroo_burger_steak/" target="_blank"><img
                                        src="{{asset('frontend/images/icon/instagram.png')}}" style="width: 3em"></a>
                                <a href="https://www.tripadvisor.ru/UserReviewEdit-g295378-d13001575-Jroo_Burger_Steak-Yalta.html"
                                   target="_blank"><img src="{{asset('frontend/images/icon/tripadvisor-new.png')}}"
                                                        style="width: 3em"></a>
                            </div>
                            <!--
                            @guest
                                <div class="login d-flex">
                                    <a href="{{route('login')}}">
                                        <img src="{{asset('frontend/images/icon/gender-neutral-user.png')}}"
                                             style="width: 3em">
                                    </a>
                                    <a href="{{route('register')}}">
                                        <img src="{{asset('frontend/images/icon/add-user-male.png')}}"
                                             style="width: 3em">
                                    </a>
                                </div>
                            @else
                                <div class="login d-flex">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{asset('frontend/images/icon/gender-neutral-user.png')}}"
                                                 style="width: 3em">
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#"><i class="fas fa-user"></i>Главная</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i>Настройки</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-sign-out-alt"></i>Выход</a>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-2"><a class="logo" href="/"><img src="{{asset('frontend/images/logo3.png')}}"
                                                                     alt=""
                                                                     style="width: 75%; margin-left: 40%"></a></div>
                    <div class="col-8">
                        <div class="navgition-menu d-flex align-items-center justify-content-center">
                            <ul class="mb-0">
                                <li class="toggleable">
                                    <a class="menu-item {{request()->is('/') ? 'active' : ''}}"
                                       href="/">Меню</a>
                                </li>
                                <li class="toggleable">
                                    <a class="menu-item {{request()->is('pay') ? 'active' : ''}}"
                                       href="{{route('pay')}}">Оплата</a>
                                </li>
                                <li class="toggleable">
                                    <a
                                        class="menu-item {{request()->is('delivery') ? 'active' : ''}}"
                                        href="{{route('delivery')}}">Доставка</a>
                                </li>
{{--                                <li class="toggleable">--}}
{{--                                    <a--}}
{{--                                        class="menu-item {{request()->is('bonus') ? 'active' : ''}}"--}}
{{--                                        href="{{route('bonus')}}">Бонусы</a>--}}
{{--                                </li>--}}
                                <li class="toggleable">
                                    <a class="menu-item {{request()->is('contact') ? 'active' : ''}}"
                                       href="{{route('contact')}}">Контакты</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="product-function d-flex align-items-center justify-content-end">
                            <div id="cart"><a class="function-icon " style="font-size: 1.6em"
                                              href="{{route('cart')}}"><i
                                        class="fas fa-shopping-basket"></i><span
                                        style="font-size: 1em" class="total">₽ 0.00</span></a></div>
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
                                                                                                style="font-size: 2.5em;"></i></a>
                            <div id="ogami-mobile-menu">
                                <button class="no-round-btn" id="mobile-menu--closebtn">Закрыть</button>
                                <div class="mobile-menu_items">
                                    <ul class="mb-0 d-flex flex-column">
                                        <li class="toggleable"><a class="menu-item"
                                                                  href="/"><img
                                                    src="{{asset('frontend/images/icon/restaurant-menu.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Меню</a><span
                                                class="sub-menu--expander"><i class="icon_plus"></i></span>
                                            <ul class="sub-menu">
                                                <li><a href="/">Категории</a></li>
                                            </ul>
                                        </li>

                                        <li class="toggleable"><a class="menu-item"
                                                                  href="{{route('pay')}}"><img
                                                    src="{{asset('frontend/images/icon/money.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Оплата</a>

                                        </li>
                                        <li class="toggleable"><a class="menu-item" href="{{route('delivery')}}"><img
                                                    src="{{asset('frontend/images/icon/delivery.png')}}"
                                                    style="width: 30px; margin-right: 5px;">Доставка</a>

                                        </li>
{{--                                        <li class="toggleable"><a class="menu-item" href="{{route('bonus')}}"><img--}}
{{--                                                    src="{{asset('frontend/images/icon/loyalty-card.png')}}"--}}
{{--                                                    style="width: 30px; margin-right: 5px;">Бонусы</a>--}}

{{--                                        </li>--}}
                                        <li class="toggleable"><a class="menu-item" href="{{route('contact')}}"><img
                                                    src="{{asset('frontend/images/icon/contact-card.png')}}"
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
                                <div class="mobile-social"><a href="https://vk.com/club136274972" target="_blank"><img
                                            src="{{asset('frontend/images/icon/vk-com.png')}}"
                                            style="width: 40px; margin-right: 5px;"></a><a
                                        href="https://www.facebook.com/jrooburgersteak/" target="_blank"><img
                                            src="{{asset('frontend/images/icon/facebook-new.png')}}"
                                            style="width: 40px; margin-right: 5px;"></a><a
                                        href="https://www.instagram.com/jroo_burger_steak/" target="_blank"><img
                                            src="{{asset('frontend/images/icon/instagram.png')}}"
                                            style="width: 40px; margin-right: 5px;"></a>
                                </div>


                                <div class="mobile-login" style="margin-top: 15px;">

                                    <a href="https://yandex.ru/maps/-/CGsruQ9e">
                                        <p class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
                                            г. Магас
                                            Проспект Зязикова,
                                            2A На крыше бизнес-отеля Магас
                                        </p>
                                    </a>
                                    <a href="">
                                        <p class="d-flex align-items-center">
                                            <i class="fas fa-phone" style="margin-right: 10px;"></i><a
                                                href="tel:+79287328477" style="color: #0b0b0b"> +7 (928) 732-84-77</a>
                                        </p>
                                    </a>
                                    <a href="">
                                        <p class="d-flex align-items-center">
                                            <i class="far fa-clock"
                                               style="margin-right: 10px;"></i>
                                            Пн-пт с {{$weekdaysStart}} до {{$weekdaysEnd}} <br>
                                            Сб-вс с {{$weekendStart}} до {{$weekendEnd}}
                                        </p>
                                    </a>

                                </div>
                            </div>
                            <div class="ogamin-mobile-menu_bg"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center">
                            <a href="/"><img src="{{asset('frontend/images/logo3.png')}}" style="width: 90%"
                                             alt=""></a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mobile-product_function d-flex align-items-center justify-content-end"><a
                                class="function-icon" href="{{route('cart')}}"><i class="fas fa-shopping-basket"
                                                                                  style="font-size: 2.9em"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="navigation-filter">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 order-1 order-md-2">--}}
{{--                        <form action="{{route('food.by-search')}}">--}}
{{--                            <div class="website-search">--}}
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <div>--}}
{{--                                        <div class="search-input">--}}
{{--                                            <input name="name" value="{{request('name')}}" required--}}
{{--                                                   class="no-round-input no-border" type="text"--}}
{{--                                                   placeholder="Поиск по блюдам">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <button class="no-round-btn">Поиск</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </header>

@yield('content')
<!-- End header-->
{{--    @include('components.partners')--}}

</div>
<!-- End partner-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 text-sm-center text-md-left">
                <div class="footer-logo text-center"><img src="{{asset('frontend/images/logo3.png')}}" alt=""
                                                          style="width: 40%"></div>
                <div class="footer-contact text-center">
                    <p>Адрес: <a href="https://yandex.ru/maps/-/CGsruQ9e" style="color: #0b0b0b">г. Магас Проспект Зязикова, 2A На крыше бизнес-отеля Магас</a> </p>
                    <p>Телефон: <a href="tel:+79287328477" style="color: #0b0b0b"> +7 (928) 732-84-77</a></p>
{{--                    <p>Email: <a href="mailto:jroo90@mail.ru" style="color: #0b0b0b">jroo90@mail.ru</a></p>--}}
                </div>
                <div class="footer-social text-center"><a class="round-icon-btn"
                                                                  href="https://www.instagram.com/panorama.magas/"
                                                                  target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>

            @if(false === env('APP_DEBUG'))
                @include("components.social_network")
            @endif
        </div>
    </div>
    <div class="footer-credit" style="background-color: #f5f5f5;">
        <div class="container">
            <div
                class="footer-creadit_block d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-baseline align-items-md-center">
                <p class="author">Copyright © {{date("Y")}} Панорама</p><img class="payment-method"
                                                                src="{{asset('frontend/images/money.jpg')}}"
                                                                style="width: 50% ;border-radius: 10px" alt="">
            </div>
        </div>
    </div>
</footer>
<!-- End footer-->
</div>

<script defer src="{{mix('frontend/js/all.js')}}"></script>
<script src="{{ asset('admin_assets/js/custom.js')}}"></script>
{!!  GoogleReCaptchaV3::init() !!}
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(61249663, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        $("#exampleModalCenter").modal('show');
    })
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/61249663" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
