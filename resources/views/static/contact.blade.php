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
    <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/org/villa_magiya/33829902970/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Вилла Магия</a><a href="https://yandex.ru/maps/977/republic-of-crimea/category/hotel/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Гостиница в Республике Крым</a><iframe src="https://yandex.ru/map-widget/v1/-/CCQhjCf6dC" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
    <div class="contact-method">
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="method-block"><i class="icon_pin_alt"></i>
            <div class="method-block_text">
              <p><a href="https://yandex.ru/maps/-/CCQxzKvz0B" style="color: #0b0b0b">пгт.Новофедоровка ул.Приморская 7</a> </p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="method-block"><i class="icon_mail_alt"></i>
            <div class="method-block_text">
              <p> <span>Телефон:</span><a href="tel:+79781030767" style="color: #0b0b0b">+7 (978) 103 07 67.</a></p>
              <p><span>Mail:</span><a href="mailto:help@magia-dostavka.ru " style="color: #0b0b0b">help@magia-dostavka.ru </a></p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="method-block"><i class="icon_clock_alt"></i>
            <div class="method-block_text">
              <p> Рады видеть Вас: <br> Будние дни 10:00 – 00:00,<br>Выходные дни 10:00 – 01:00</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="leave-message">
      <h1 class="title">Написать нам</h1>
      <p>Есть предложения, пожелания или коментарии, будем рады обратной связи.</p>
      <form action="/contact/feedback" method="post">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-12 col-md-6">
            <input class="no-round-input" type="text" name="name" placeholder="Ваше Имя">
          </div>
          <div class="col-12 col-md-6">
            <input class="no-round-input" type="text" name="phone" placeholder="Ваш номер телефона">
          </div>
          <div class="col-12">
            <textarea class="textarea-form" name="feedback" cols="30" rows="10" placeholder="Оставьте Ваш отзыв"></textarea>
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
