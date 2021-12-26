<?php
/**
 * @var \App\Models\Order\Order $model
 */

?>

<li>
    <figure><img src="img/item_1.jpg" alt=""></figure>
    <h4>{{$model->name}} # {{$model->id}} <i class="pending"> {{$model::getStatusesVariants()[$model->status]}}</i></h4>
    <ul class="booking_list">

        <li><strong style="font-weight: bold;">Дата:</strong>{{$model->date_delivery}}</li>
        <li><strong style="font-weight: bold;">Время:</strong>{{$model->time_delivery}}</li>
{{--        <li><strong style="font-weight: bold;">Адрес:</strong>{{$model->address}}</li>--}}
        <li><strong style="font-weight: bold;">Тип доставки:</strong>{{$model::getDeliveryVariants()[$model->delivery_type]}}</li>
        @if($model->delivery_type === $model::DELIVERY_TYPE_COURIER)
            <li><strong style="font-weight: bold;">Адрес:</strong>{{$model->city}}</li>
        @endif
        <li><strong style="font-weight: bold;">Телефон:</strong>{{$model->phone}}</li>
{{--        <li><strong style="font-weight: bold;">Телефон:</strong><a href="tel:+{{$model->phone}}">+{{$model->phone}}</a> </li>--}}
        <li><strong style="font-weight: bold;">Сумма:</strong>{{$model->total + $model->delivery_cost}}</li>


    </ul>
    <p>
    </p>
    <ul class="buttons">
        <li><a href="{{route('order.show', $model->id)}}" class="btn_1 gray"><i class="fa fa-fw fa-eye"></i> Посмотреть</a></li>
        <li><a href="{{route('order.edit', $model->id)}}" class="btn_1 gray"><i class="fa fa-fw fa-edit"></i>Изменить</a></li>
        <li>
            <a class="btn_1 gray" href="{{route('order.destroy', $model->id)}}" title="Удалить"
               aria-label="Удалить"
               data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="delete"
               data-redirect="{{route('order.index')}}">
                <i class="fa fa-trash"></i> Удалить
            </a>
        </li>
    </ul>
</li>
