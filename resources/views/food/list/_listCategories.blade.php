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
        <ul>
            @foreach($categories as $category)
                <li><a class="department-link" href="{{route('food.by-category-slug', $category->slug)}}">
                        <img
                            src="{{$category->icon}}"
                            style="width: 30px ; margin-right: 15px;">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
