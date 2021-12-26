<?php
/**
 * @var \App\Widgets\Breadcumb\models\Breadcumb[] $items
 */
?>

<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            @foreach($items as $item)
                <li>
                    <a class="breadcrumb-link {{false === next($items) ? 'active' : ''}}" href="{{$item->link}}">
                        <i class="{{$item->icon}}"></i>{{$item->label}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- End breadcrumb-->
