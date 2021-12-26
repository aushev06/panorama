<div class="shop-sidebar_price-filter">
    <div class="price-filter_top mini-tab-title underline">
        <h2 class="title">Фильтр стоимости</h2>
    </div>
    <div class="price-filter_bottom">
        <p>
            <label for="amount">По цене:</label>
        <div class="filter-group">
            <input id="amount" type="text" readonly="">
            {{--<button class="normal-btn filter">Показать</button>--}}
        </div>
        </p>
        <div id="slider-range" data-min="{{$prices->min ?? 0}}" data-max="{{$prices->max ?? 0}}"></div>
    </div>
</div>
