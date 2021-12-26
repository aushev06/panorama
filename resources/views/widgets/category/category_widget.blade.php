<?php
/**
 * @var \App\Models\Category\Category[] $categories
 */

?>
<div class="shop-sidebar_department">
    <div class="department_top mini-tab-title underline">
        <h2 class="title">Категории</h2>
    </div>
    <div class="department_bottom">
        <ul class="category-list">
            @foreach($categories as $category)
                <li {{request()->is('food/category/' . $category->slug) ? 'class=active' : ''}}>
                    <a class="department-link" href="{{route('food.by-category-slug', $category->slug)}}">
                        <img
                            src="{{$category->icon}}"
                            style="width: 30px ; margin-right: 15px;">{{$category->name}}
                    </a>
                </li>
            @endforeach

            <li {{request()->is('foods') ? 'class=active' : ''}}>
                <a class="department-link"
                   href="{{route('foods.index')}}">
                    <img
                        src="http://jro.webshad.ru/storage/categories/STbE0ewEd1Y6BL9h8haZrCS8uGF04Y4R89v9WFQT.png"
                        style="width: 30px ; margin-right: 15px;">Все блюда
                </a>
            </li>
        </ul>
    </div>
</div>
