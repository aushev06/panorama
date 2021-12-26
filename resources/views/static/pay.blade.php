<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 10.09.2019
 * Time: 20:40
 */
?>
@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                \App\Widgets\Breadcumb\models\Breadcumb::create('Оплата', '#'),
            ]])
        }}
    <div class="about-us">
        <div class="container">
            <div class="our-story">
                <div class="row">
                    <div class="col-12" style="margin-bottom: 20px;">
                        <h1 class="text-center" style="font-size: 36px; font-weight: bold;">Мы принимаем оплату</h1>
                        <div class="customer-benefit">
                            <div class="ogami-container-fluid">
                                <div class="benefit-block">
                                    <div class="our-benefits shadowless benefit-border">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="benefit-detail d-flex flex-column align-items-center"><img src="{{asset('frontend/images/icon/delivery-pay.png')}}" alt="">
                                                    <br>
                                                    <h5 class="benefit-title" style="text-align: center;">Наличными курьеру.</h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="benefit-detail d-flex flex-column align-items-center"><img src="{{asset('frontend/images/icon/nal.png')}}" alt="">
                                                    <br>
                                                    <h5 class="benefit-title" style="text-align: center;">В кафе при получении заказа.</h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="benefit-detail d-flex flex-column align-items-center"><img src="{{asset('frontend/images/icon/online-money-transfer.png')}}" alt="">
                                                    <br>
                                                    <h5 class="benefit-title" style="text-align: center;">Безналичный расчет курьеру</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="our-story_text">
                            <h1 class="title green-underline">ОПЛАТА НАЛИЧНЫМИ</h1>
                            <p>Наличные — это самый привычный способ оплаты заказа по факту его получения. Если вам потребуется сдача, просто предупредите об этом оператора или оставьте соответствующий комментарий при оформлении заказа онлайн. Курьер привезет сдачу вместе с вашим заказом.</p>
                            <h1 class="title green-underline">БЕЗНАЛИЧНЫЙ РАСЧЕТ КУРЬЕРУ</h1>
                            <p>Нет наличных, а ближайший банкомат находится в трех кварталах? Вы можете оплатить свой заказ банковской картой при получении. После оформления заказа, в течение 10 минут, с Вами обязательно свяжется оператор для подтверждения способа оплаты</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <img src="{{asset('frontend/images/pay-pay12.png')}}" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
