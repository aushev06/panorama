<?php

/**
 * @var \App\Models\Category\Category[] $categories
 */
?>
@extends('layout.frontend')

@section('content')
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
                            <div class="col-6 col-sm-4 col-lg-3">
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
