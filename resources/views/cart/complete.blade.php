@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                       \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                       \App\Widgets\Breadcumb\models\Breadcumb::create('Корзина', route('cart')),
                       \App\Widgets\Breadcumb\models\Breadcumb::create('Оформление заказа', route('checkout')),
                        \App\Widgets\Breadcumb\models\Breadcumb::create('Завершение', '#'),
    ]])
    }}
    <div class="order-step">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="order-step_block">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <div class="step-block step-block--1">
                                    <div class="step">
                                        <h2>Корзина</h2><span>01</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="step-block">
                                    <div class="step">
                                        <h2>Оформление</h2><span>02</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="step-block active">
                                    <div class="step">
                                        <h2>Завершение</h2><span>03</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-checkout">
        <div class="container">
            <div class="alert alert-success">
                Спасибо за заказ! <br> <br>
                С Вами обязательно свяжется оператор в течении 10 минут и уточнит более подробно условия доставки.
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="benefit-block">
                        <div class="our-benefits shadowless benefit-border">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="benefit-detail d-flex flex-column align-items-center"><img class="" src="{{asset('frontend/images/icon/restaurant-menu.png')}}" alt=""  style="width: 25%;">
                                        <br>
                                        <h5 class="benefit-title">Вернуться в меню</h5>
                                        <br>
                                        <button class="normal-btn" onclick="location.href = '/'">Перейти</button>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="benefit-detail d-flex flex-column align-items-center"><img class="" src="{{asset('frontend/images/JBS_Logo.png')}}" alt="" style="width: 25%;">
                                        <br>
                                        <h5 class="benefit-title">Основной сайт</h5>
                                        <br>
                                        <button class="normal-btn" onclick="location.href = 'http://jroo.cafe/'">Перейти</button>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4">
                                    <div class="benefit-detail d-flex flex-column align-items-center"><img class="" src="{{asset('frontend/images/icon/tripadvisor.png')}}" alt=""  style="width: 25%;">
                                        <br>
                                        <h5 class="benefit-title" >Посмотреть отзывы на трипадвизоре </h5>
                                        <br>
                                        <button class="normal-btn" onclick="location.href = 'https://www.tripadvisor.ru/UserReviewEdit-g295378-d13001575-Jroo_Burger_Steak-Yalta.html'">Перейти</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
