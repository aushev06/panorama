<?php
use App\Models\Settings;
$settings = new Settings();
$activeSettings = $settings->getActiveSettings();
$weekdaysStart = $settings->getWeekdaysOpen($activeSettings);
$weekdaysEnd   = $settings->getWeekdaysClose($activeSettings);
$weekendStart  = $settings->getWeekendOpen($activeSettings);
$weekendEnd    = $settings->getWeekendClose($activeSettings);
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
                            <p>На нашем сайте вы всегда можете заказать доставку еды домой, в офис курьером или самовывозом со скидкой 10%. Для этого необходимо сформировать корзину из блюд, представленных на сайте, и оформить заказ.  Также всегда есть возможность сделать заказ по телефону
                                <a href="tel:+79780873337" style="color: #0b0b0b">+7 (978) 087 33 37.</a></p>
                            <p>Доставим ваш заказ в любой день недели: и в выходные, и в праздники. Ваш горячий завтрак, обед или ужин не остынет по дороге — мы позаботимся об этом. Наши термосумки поддерживают температуру, а значит, заказ приедет горячим вне зависимости от расстояния до вашего дома или офиса!</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <script type="text/javascript" charset="utf-8" async
                                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af79795d31041e3753d776317e3b86ae6a68cf6fbff5bb1f57d65e5cbdca6fb95&amp;width=100%25&amp;height=450&amp;lang=ru_RU&amp;scroll=true">
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
                    <p>Пн-пт с {{$weekdaysStart}} до {{$weekdaysEnd}}<br>
                        Сб-вс с {{$weekendStart}} до {{$weekendEnd}}
                    </p>
                </div>
                <div class="faq-question"><i class="icon_plus"></i>
                    <h3 class="faq-question">Зоны доставки</h3>
                </div>
                <div class="faq-answer">
                    <p>Зоны доставки изображены на карте , отображенной выше.<br>
                </div>
            </div>
        </div>
    </div>


@endsection
