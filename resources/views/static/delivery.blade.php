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
                \App\Widgets\Breadcumb\models\Breadcumb::create('Доставка', '#'),
            ]])
        }}
    <div class="about-us">
        <div class="container">
            <div class="our-story">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="our-story_text">
                            <h1 class="title green-underline">О нашей доставке</h1>
                            <p>Мы используем самые лучшие ингредиенты и начинаем готовить только после получения вашего заказа. Умелые руки наших поваров приготовят ваш заказ быстро, качественно, а главное — с любовью.</p>
                            <p>На нашем сайте вы всегда можете заказать доставку еды домой, в офис курьером или самовывозом. Для этого необходимо сформировать корзину из блюд, представленных на сайте и оформить заказ. Также всегда есть возможность сделать заказ по телефону
                                <a href="tel:+79781030767" style="color: #0b0b0b">+7 (978) 103 07 67.</a></p>
                            <p>Доставим ваш заказ в любой день недели: и в выходные, и в праздники. Ваш горячий завтрак, обед или ужин не остынет по дороге — мы позаботимся об этом. Наши термосумки поддерживают температуру, а значит, заказ приедет горячим вне зависимости от расстояния до вашего дома или офиса!</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad61bc0f6169bf6bd45cecc17ee28ff7f7947f6210651df999c1be55f1bd574be&amp;width=100%25&amp;height=444&amp;lang=ru_RU&amp;scroll=true">
                        </script>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="faq">
        <div class="container">
            <div id="accordion">
                <div class="faq-question"><i class="icon_plus"></i>
                    <h3 class="faq-question">Время доставки</h3>
                </div>
                <div class="faq-answer">
                    <p>Будние дни 10:00 – 00:00<br>Выходные дни 10:00 – 01:00
                    </p>

                </div>
                <div class="faq-question"><i class="icon_plus"></i>
                    <h3 class="faq-question">Зоны доставки</h3>
                </div>
                <div class="faq-answer">
                    <p>Зоны доставки изображены на карте , отображенной выше.
                    Бесплатная доставка от 800р. По г.Саки, пгт.Новофедоровка и с.Михайловка.<br>
                    Лесновка – 100р<br>
                    Орехово – 100р<br>
                    Владимировка – 150р<br>
                    Гаршино – 150р<br>
                    Куликовка – 150р<br>
                    Прибрежное – 150р<br>
                    Евпаторийское шоссе – 150р<br>
                    Червоное – 150р<br>
                    Ивановка – 150р<br>
                    Шелковичное – 200р<br>
                    Охотниково (Орлянка) – 200р<br>
                    Химпоселок – 200р<br>
                    Геройское – 200р<br>
                    Яркое – 250р<br>
                    Крымское – 250р<br>
                    Митяево – 250р<br>
                    </p>
                    <br>
                </div>
            </div>
        </div>
    </div>


@endsection
