<?php
/**
 * @var \App\Models\Food\models\FoodViewModel $food
 */
?>
<div class="product animated grid-view zoomIn">

    @if(false === $food->active)
        <div
            class="w-100 h-100 d-flex align-items-center flex-column justify-content-center position-absolute"
            style="background: #d8d8d891; color: #662c00; z-index: 1000;">
            <i class="far fa-sad-tear fa-3x"></i>
            <span class="mt-3 font-weight-bold">
                                    Всё съели
                            </span>
        </div>
    @endif

    <div class="product-img_block">
        <a class="view product-img" data-id="{{$food->id}}" href="javascript:;">
            <img src="{{$food->img}}" alt="Доставка {{$food->name}}" title="Доставка {{$food->name}}">
        </a>
    </div>

    <div class="product-info_block">
        {{--                        <h5 class="product-type mt-2">{{$food->category}}</h5>--}}
        <a class="view product-name mt-4" href="javascript:;" data-id="{{$food->id}}">{{$food->name}}</a>

        @if(true === $food->active)
            <h3 class="product-price">₽{{$food->properties[0]->price}}
                @if($food->properties[0]->old_price)
                    <del>₽{{$food->properties[0]->old_price}}</del>
                @endif
            </h3>
        @endif
        {{--                        <h5 class="product-rated"><i class="icon_star"></i><i--}}
        {{--                                class="icon_star"></i><i class="icon_star"></i><i--}}
        {{--                                class="icon_star"></i><i--}}
        {{--                                class="icon_star-half"></i><span>(5)</span></h5>--}}
        <p class="product-describe">{{$food->description}}</p>
        <h5 class="product-avaiable">Выход: <span>{{$food->foodInfo->weight}} </span></h5>
        {{--                        <button class="add-to-wishlist button-borderless"><i--}}
        {{--                                class="icon_heart_alt"></i></button>--}}
    </div>
    <div class="grid-buttons">
        {{--<button class="add-to-wishlist round-icon-btn"><i--}}
        {{--class="icon_heart_alt"></i></button>--}}
        @if(true === $food->active)
            <button class="quickview view round-icon-btn" data-id="{{$food->id}}"><i
                        class="far fa-eye"></i>
            </button>
            <button data-food-property-id="{{$food->properties[0]->id}}"
                    class="add-to-cart round-icon-btn"
                    style="width: 190px !important; background-color: #76ea28 !important;">
                <i class="fas fa-cart-plus"></i> Добавить в заказ
            </button>
            {{--                            <button class="quickview view round-icon-btn" data-id="{{$food->id}}"><i--}}
            {{--                                    class="far fa-eye"></i>--}}
            {{--                            </button>--}}
        @endif
    </div>
    <div class="product-select_list">
        <p class="delivery-status">Быстрая доставка</p>
        <h3 class="product-price">
            @if($food->properties[0]->old_price)
                <del>₽{{$food->properties[0]->old_price}}</del>
            @endif
            ₽{{$food->properties[0]->price}}
        </h3>
        <button data-food-property-id="{{$food->properties[0]->id}}"
                class="add-to-cart normal-btn outline">
            Добавить в заказ
        </button>
        <!-- <button class="add-to-compare normal-btn outline">+ Добавить в
            избранное
        </button> -->
    </div>
</div>
