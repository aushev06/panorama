<?php
/**
 * @var \App\Models\Cart\models\CartViewModel $model
 */


?>

@extends('layout.frontend')

@section('content')
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
                    \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
                    \App\Widgets\Breadcumb\models\Breadcumb::create($breadcumb, '#'),
                ]])
        }}


    <div class="order-step">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="order-step_block">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <div class="step-block active">
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

    <div class="shopping-cart">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-table">
                        <table class="table cart">
                            <colgroup>
                                <col span="1" style="width: 15%">
                                <col span="1" style="width: 30%">
                                <col span="1" style="width: 1%">
                                <col span="1" style="width: 20%">
                                <col span="1" style="width: 10%">
                                <col span="1" style="width: 10%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="product-iamge" scope="col">Фото</th>
                                <th class="product-name"  scope="col">Название</th>
{{--                                <th class="product-price" scope="col">Цена</th>--}}
                                <th class="product-quantity"  scope="col">Кол-во</th>
                                <th class="product-total"  scope="col">Сумма</th>
                                <th class="product-clear" scope="col">
                                    <a href="{{route('cart.destroy', $model->id)}}" class="btn"
                                       title="Очистить корзину?" aria-label="Удалить"
                                       data-confirm="Вы уверены, что хотите очистить корзину?"
                                       data-method="delete" data-redirect="{{route('home')}}"><i
                                            class="icon_close"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model->cartProperties ?? [] as $property)
                                @include('cart.components.card', ['property' => $property])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            <!--
                <div class="col-12 col-sm-8">

                    <div class="coupon">
                        @if(Session::has('message'))
                            <div class="alert {{Session::get('message')['class']}}">
                                {{Session::get('message')['message']}}
                            </div>
                        @endif
                        <form action="{{route('cart.activate-coupon')}}" method="post">
                            @csrf
                            <input class="no-round-input" name="coupon" type="text" placeholder="ВАШ купон">
                            <button class="no-round-btn smooth">Активировать купон</button>
                        </form>
                    </div>

                </div>
                -->
            </div>
            <div class="row align-items-center justify-content-end" style="margin-top: -45px;">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="cart-total_block">
                        <h2>Сумма заказа</h2>
                        <table class="table">
                            <colgroup>
                                <col span="1" style="width: 50%">
                                <col span="1" style="width: 50%">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>Сумма</th>
                                <td class="total"><i class="fas fa-ruble-sign" style="font-size: 0.7em"></i> 0.00</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="checkout-method">
                            <a href="{{route('checkout')}}" class="checkout">
                                <button class="normal-btn"> Оформить заказ</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
