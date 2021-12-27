<?php

/**
 * @var \App\Models\Category\Category[] $categories
 */
?>
@extends('layout.frontend')

@section('content')

    <div class="deal-of-week" style="margin-bottom: 0px !important;">
        <div class="container">
            <div class="col-12 text-center" style="background: linear-gradient(to right,#f6efd2,#cead78); border-radius: 10px; padding: 15px;">
                <h1 style="font-size: 1.4em; color: #2C150C;font-weight: bold; line-height: 30px; margin-bottom: 0px !important;">Доставка по-настоящему вкусной еды от ресторана "Панорама"</h1>
            </div>
        </div>
        <div class="container" style="margin-top: 10px;">
            <div class="col-12 text-center">
            </div>
        </div>
{{--        <div class="container">--}}
{{--            <div class="row justify-content-md-center" style="margin-top: 10px;">--}}
{{--                <div class="col-12 col-lg-5 text-center" style="margin-top: 10px;">--}}
{{--                    <span style="font-size: 2.8em; font-weight:bold;">★4,7</span>  <p style="margin-top: 5px;">средняя оценка на основании 524 отзывов</p>--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-5 text-center" style="margin-top: 10px;">--}}
{{--                    <span style="font-size: 2.8em;font-weight:bold;">94,8%</span> <p style="margin-top: 5px;">клиентов остались довольными и счастливыми</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    {{ Widget::run('breadcumb.breadcumbWidget', ['items' => [
          \App\Widgets\Breadcumb\models\Breadcumb::create('Главная', '/', 'fas fa-home'),
          \App\Widgets\Breadcumb\models\Breadcumb::create('Категории', '#'),
      ]])
  }}
    <div class="shop-layout">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert {{Session::get('message')['class']}}">
                    {{Session::get('message')['message']}}
                </div>
            @endif
            <div class="ogami-container-fluid">
                <div class="slider-banner">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-6 col-sm-4 col-lg-2">
                                <a href="{{route('food.by-category-slug', $category->slug)}}">
                                    <img class="img-fluid" src="{{$category->img}}"
                                         alt="{{$category->name}}" style="margin-bottom: 8%; border-radius: 14px;"
                                         title="{{$category->name}}">
                                </a>
                            </div>
                        @endforeach

                        {{--                        <div class="col-12 col-sm-4 col-lg-4">--}}
                        {{--                            <a href="{{route('foods.index')}}">--}}
                        {{--                                <img class="img-fluid"--}}
                        {{--                                     src="{{asset('frontend/images/categories/other.jpg')}}"--}}
                        {{--                                     alt="Все блюда" style="margin-bottom: 8%; border-radius: 14px;" title="Все блюда">--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.story')

    <div class="container feature-products feature-products_v2">
        <div class="ogami-container-fluid">
            @foreach($categoriesWithFoods as $categoryViewModel)
                <div class="row align-items-center align-content-center">
                    <div class="col-6">
                        <h1 class="title mx-auto">{{$categoryViewModel->name}}</h1>
                    </div>
                    <div class="col-6 text-right" style="margin-bottom: 30px;">
                        <a href="{{route('food.by-category-slug', ['slug' => $categoryViewModel->slug])}}" target="_blank" style="font-weight: bold;font-family: Gussi;font-size: 14px;color: white;padding: 4px 15px;border-radius: 10px;background-color: black;">Посмотреть еще</a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @foreach($categoryViewModel->foodProperties as $index => $foodViewModel)
                                @if($index <= 2)
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-4" style="margin-bottom: 30px;margin-top: 2%;">
                                        @component('food.list._cardFood', ['food' => $foodViewModel])@endcomponent
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('components.story2')


    @if($isOrdersOff && $isOrdersOff->status === \App\Models\Settings::STATUS_ACTIVE)
        <!--Modal-->
        <div class="modal" id="modal-notif" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Уведомление</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{$isOrdersOff->value ?: 'На данный момент заказы не принимаются!'}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function load() {
                if (!window.jQuery) return setTimeout(load, 50);
                $('#modal-notif').modal({})
            }, false);
        </script>
        <!--End Modal-->
    @endif

    <div class="deal-of-week">
        <div class="container">
            <div class="col-12 text-center" style="background: linear-gradient(to right,#f6efd2,#cead78); border-radius: 10px; padding: 30px;">
                <p style="font-size: 1em; color: #2C150C;font-weight: bold; line-height: 30px;">Панорама включает в себя простоту и локаничность интерьера, безупречный вкус качественных местных продуктов и доступную стоимость блюд.
                    Мы удивим Вас простотой исполнения и в то же время изяществом вкуса сочных стейков, приготовленных из мяса местного производства.</p>
            </div>
        </div>
    </div>
    <!-- End shop layout-->


    {{--<div class="coming-soon">--}}
    {{--    <div class="container">--}}
    {{--        <div class="coming-soon_block" style="padding: 10px; background: #2C150C; border-radius: 10px;">--}}
    {{--            <h1 class="title" style="color: white;">Технические работы на сайте</h1>--}}
    {{--            <h5 class="subtitle" style="color: white; margin-bottom: 20px !important;">На данный момент на сайте проводяться технические работы. Связанные с обновлением меню. </h5>--}}
    {{--            <button type="button" class="btn btn-secondary" style="margin-bottom: 10px;"><a href="http://jroo.cafe/#menu" target="_blank" style="color: white;">Ознакомиться с новым меню</a></button>--}}
    {{--            <div class="follow-us">--}}
    {{--                <h5 style="color: white;">Вы можете посмотреть на нас в соц. сетях</h5>--}}
    {{--                <div class="social"><a class="round-icon-btn" href="https://www.facebook.com/jrooburgersteak/" target="_blank"><i class="fab fa-facebook-f"> </i></a><a class="round-icon-btn" href="https://vk.com/club136274972" target="_blank"><i class="fab fa-vk"> </i></a><a class="round-icon-btn" href="https://www.instagram.com/jroo_burger_steak/" target="_blank"><i class="fab fa-instagram"></i></a></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
