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
                \App\Widgets\Breadcumb\models\Breadcumb::create('Программа лояльности', '#'),
            ]])
        }}

    <div class="about-us">
        <div class="container">
            <div class="our-story">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="our-story_text">
                            <h1 class="title green-underline">Программа лояльности</h1>
                            <p>КАК ПОЛУЧИТЬ ДИСКОНТНУЮ КАРТУ ? <br>
                                1. Совершить заказ в Jroo burger & steak или club-café Geneva.<br>
                                2. Заполнить анкету в кафе на получение карты.<br>
                            </p>
                            <p>Первоначальная скидка 5% <br>
                                ➡️При оплате счётов на общую сумму 3.000₽, скидка автоматически увеличивается до 7%<br>
                                ➡️Далее накопление суммы с 0₽ до 15.000₽, скидка автоматически становится 10%<br>
                                ➡️Затем накопление так же начинается с 0₽ до 40.000₽, после чего скидка автоматически увеличивается до 15%<br>
                                ➡️Накопление с 0₽ до 60.000₽, скидка автоматически увеличивается до максимальной 20%
                                Первоначальная скидка 5%<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <img src="{{asset('frontend/images/bonus.jpg')}}" alt="" style="width: 100%;">

                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
