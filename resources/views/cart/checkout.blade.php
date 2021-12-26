<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 15.09.2019
 * Time: 15:15
 */

use App\Models\Order\Order;

?>
@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                    \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                    \App\Widgets\Breadcumb\models\Breadcumb::create('Корзина', route('cart')),
                    \App\Widgets\Breadcumb\models\Breadcumb::create('Оформление заказа', '#'),
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
                                <div class="step-block active">
                                    <div class="step">
                                        <h2>Оформление</h2><span>02</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="step-block">
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
            <form action="{{route('cart.addOrder')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <h2 class="form-title">Ваши данные</h2>
                        <div class="form-row">
                            <div class="form-group col-md-6"">
                                <input type="radio" name="delivery_type" id="pickup"
                                       value="{{Order::DELIVERY_TYPE_PICKUP}}" />
                                <label for="pickup"> <i class="fas fa-shopping-bag"></i> Самовывоз</label>
                            </div>
                            <div class="form-group col-md-6"">
                                <input type="radio" name="delivery_type" id="courier"
                                       value="{{Order::DELIVERY_TYPE_COURIER}}" checked />
                                <label for="courier"> <i class="fas fa-truck"></i> Доставка курьером</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFirstName">Имя*</label>
                                <input class="no-round-input-bg" name="name" type="text" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputLastName">Телефон*</label>
                                <input class="no-round-input-bg" name="phone" id="phone" type="text" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputFirstName">Размер S</label>
                                <input class="no-round-input-bg" name="gloves_s" id="gloves_s" type="text"
                                       placeholder="Кол-во перчаток">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputLastName">Размер M</label>
                                <input class="no-round-input-bg" name="gloves_m" id="gloves_m" type="text"
                                       placeholder="Кол-во перчаток">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputLastName">Размер L</label>
                                <input class="no-round-input-bg" name="gloves_l" id="gloves_l" type="text"
                                       placeholder="Кол-во перчаток">
                            </div>
                        </div>
                        <!--
                       <div class="gloves">
                           <div class="form-row align-items-center">


                              <div class="form-group col-md-6">
                                  <label for="inputFirstName">Кол-во перчаток</label>
                                  <input class="no-round-input-bg" name="glovesCount[]" type="text" required="">
                              </div>


                              <div class="form-group col-md-5">
                                  <label for="inputCountry">Размер</label>
                                  <select class="no-round-input-bg" name="glovesSize[]" id="inputContry">
                                      <option value="1">S</option>
                                      <option value="2">M</option>
                                      <option value="3">L</option>
                                  </select>
                              </div>


                              <div class="form-group col-md-2 text-center">
                                  <button type="button" class="btn btn-primary mt-3 gloves-add" style="background: #662c00; border: none;">+
                                  </button>
                              </div>

                            </div>
                        </div>
                        -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputStreet">Сдача с*</label>
                                <input class="no-round-input-bg" id="inputStreet" name="change" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStreet">Кол-во приборов</label>
                                <input class="no-round-input-bg" id="inputStreet" name="number_appliances" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 hide-pickup">
                                <label for="inputCompanyName">Город*</label>
                                <input class="no-round-input-bg" name="city" type="text">
                            </div>
                            <div class="form-group col-md-4 hide-pickup">
                                <label for="inputCompanyName">Улица*</label>
                                <input class="no-round-input-bg" name="street" type="text">
                            </div>
                            <div class="form-group col-md-4 hide-pickup">
                                <label for="inputCompanyName">Дом*</label>
                                <input class="no-round-input-bg" name="house" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 hide-pickup">
                                <label for="inputCompanyName">Подъезд*</label>
                                <input class="no-round-input-bg" name="entrance" type="text">
                            </div>
                            <div class="form-group col-md-3 hide-pickup">
                                <label for="inputCompanyName">Корпус*</label>
                                <input class="no-round-input-bg" name="building"  type="text">
                            </div>
                            <div class="form-group col-md-3 hide-pickup">
                                <label for="inputCompanyName">Квартира*</label>
                                <input class="no-round-input-bg" name="apartment" type="text">
                            </div>
                            <div class="form-group col-md-3 hide-pickup">
                                <label for="inputCompanyName">Домофон*</label>
                                <input class="no-round-input-bg" name="intercom"  type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNote">Коментарий к заказу (укажите степень прожарки, остроту блюда)</label>
                            <textarea class="textarea-form-bg" id="coment" name="comment" cols="30" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <h2 class="form-title">Ваш заказ</h2>
                        <div class="shopping-cart">
                            <div class="form-group">
                                <input type="radio" name="pay_type" id="shipping" value="{{Order::TYPE_CASH}}"
                                       checked="">
                                <label for="shipping">Оплата наличными</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="pay_type" id="paypal" value="{{Order::TYPE_ONLINE}}">
                                <label for="paypal">Онлайн оплата</label>
                            </div>
                            <hr>

                            <button type="submit" class="normal-btn submit-btn"> Заказать</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
