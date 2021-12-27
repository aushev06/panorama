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
            \App\Widgets\Breadcumb\models\Breadcumb::create('Контакты', '#'),
        ]])
    }}

<!-- End breadcrumb-->
<div class="contact-us">
  <div class="container">
      <iframe src="https://yandex.ru/map-widget/v1/-/CCUy5Af7DB" width="100%" height="400" frameborder="1" allowfullscreen="true"></iframe>
    <div class="contact-method">
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="method-block"><i class="icon_pin_alt"></i>
            <div class="method-block_text">
              <p><a href="https://yandex.ru/maps/org/panorama/171760815629/?from=mapframe&ll=44.805559%2C43.174940&source=mapframe&utm_source=mapframe&z=18.73" style="color: #0b0b0b">г. Магас Проспект Зязикова, 2A. На крыше бизнес-отеля Магас</a> </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="method-block"><i class="icon_mail_alt"></i>
            <div class="method-block_text">
              <p> <span>Телефон:</span>‎<a href="tel:+79287328477" style="color: #0b0b0b"> +7 (928) 732-84-77</a></p>
{{--              <p><span>Mail:</span><a href="mailto:jroo90@mail.ru" style="color: #0b0b0b">jroo90@mail.ru</a></p>--}}
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="method-block"><i class="icon_clock_alt"></i>
            <div class="method-block_text">
              <p> Рады видеть Вас: <br> в Пн-пт с 9:00 до 22:00,<br>Сб-вс с 10:00 до 22:00</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="leave-message">
      <h1 class="title">Написать нам</h1>
      <p>Есть предложения, пожелания или коментарии, будем рады обратной связи.</p>
      <form action="" method="post">
        <div class="row">
          <div class="col-12 col-md-6">
            <input class="no-round-input" type="text" placeholder="Имя">
          </div>
          <div class="col-12 col-md-6">
            <input class="no-round-input" type="email" placeholder="Email">
          </div>
          <div class="col-12">
            <textarea class="textarea-form" name="" cols="30" rows="10" placeholder="Ваше сообщение"></textarea>
          </div>
            <div class="col-12" style="margin-top: 10px;">
                <button class="no-round-btn">Отправить</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End contact us-->

@endsection
