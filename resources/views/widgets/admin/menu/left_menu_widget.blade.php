<?php
/**
 * @var \App\Models\Category\Category[] $items
 */
?>

<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{route('admin.index')}}">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Доска</span>
            </a>
        </li>


{{--        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">--}}
{{--            <a class="nav-link" href="{{route('ingridients.index')}}">--}}
{{--                <i class="fa fa-stop" aria-hidden="true"></i>--}}
{{--                <span class="nav-link-text">Стоп лист</span>--}}
{{--            </a>--}}
{{--        </li>--}}


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSettings"
               data-parent="#Categories">
                <i class="fa fa-book"></i>
                <span class="nav-link-text">Настройки</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseSettings">
                <li>
                    <a class="nav-link" href="{{route('setting.index')}}">
                        <i class="fa fa-stop" aria-hidden="true"></i>
                        <span class="nav-link-text">Настройки подключений</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('site-setting.index')}}">
                        <i class="fa fa-stop" aria-hidden="true"></i>
                        <span class="nav-link-text">Настройки сайта</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Категории">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCategories"
               data-parent="#Categories">
                <i class="fa fa-book"></i>
                <span class="nav-link-text">Категории</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseCategories">
                <li>
                    <a href="{{route('categories.index')}}">Все</a>
                </li>
                <li>
                    <a href="{{route('categories.create')}}">Создать</a>
                </li>
            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Еда">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseFood"
               data-parent="#Food">
                <i class="fa fa-cutlery" aria-hidden="true"></i>
                <span class="nav-link-text">&nbsp;Блюда</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseFood">
                <li>
                    <a href="{{route('food.index')}}">Все</a>
                </li>
                @foreach($items as $category)
                    <li {{request('category') == $category->id ? 'class=active' : ''}}>
                        <a href="{{route('food.index', ['category' => $category->id])}}">{{$category->name}}</a>
                    </li>
                @endforeach
                <li>
                    <a href="{{route('food.create')}}">Добавить</a>
                </li>
            </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Категории">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseOptionCategories"
               data-parent="#Categories">
                <i class="fa fa-book"></i>
                <span class="nav-link-text">Категории опций</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseOptionCategories">
                <li>
                    <a href="{{route('option-categories.index')}}">Все</a>
                </li>
                <li>
                    <a href="{{route('option-categories.create')}}">Создать</a>
                </li>
            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Категории">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseOption"
               data-parent="#Categories">
                <i class="fa fa-book"></i>
                <span class="nav-link-text">Опции</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseOption">
                <li>
                    <a href="{{route('options.index')}}">Все</a>
                </li>
                <li>
                    <a href="{{route('options.create')}}">Создать</a>
                </li>
            </ul>
        </li>


{{--        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Купоны">--}}
{{--            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCoupon"--}}
{{--               data-parent="#Food">--}}
{{--                <i class="fa fa-align-justify" aria-hidden="true"></i>--}}
{{--                <span class="nav-link-text">&nbsp;Купоны</span>--}}
{{--            </a>--}}
{{--            <ul class="sidenav-second-level collapse" id="collapseCoupon">--}}
{{--                <li>--}}
{{--                    <a href="{{route('coupon.index')}}">Все</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{route('coupon.create')}}">Добавить</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        @if( config('app.SEND_PHONE_MESSAGE_OPERATION') === true )
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Смс коды">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSms">
                <i class="fa fa-align-justify" aria-hidden="true"></i>
                <span class="nav-link-text">&nbsp;Смс коды</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseSms">
                <li>
                    <a href="{{route('sms.index')}}">Все</a>
                </li>
            </ul>
        </li>
        @endif

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Акции и предложения">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePromotions">
                <i class="fa fa-align-justify" aria-hidden="true"></i>
                <span class="nav-link-text">&nbsp;Акции и предложения</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapsePromotions">
                <li>
                    <a href="{{route('promotions.index')}}">Все</a>
                </li>

                <li>
                    <a href="{{route('promotion-cards.index')}}">Карточки</a>
                </li>
            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Заказы">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseOrder"
               data-parent="#Order">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <span class="nav-link-text">&nbsp;Заказы</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseOrder">
                <li>
                    <a href="{{route('order.index')}}">Все</a>
                </li>
                <li>
                    <a href="{{route('order.create')}}">Добавить</a>
                </li>
            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Очистка кэша">
            <a class="nav-link" href="{{route('cache:clear')}}">
                <i class="fa fa-stop" aria-hidden="true"></i>
                <span class="nav-link-text">Очистка кэша</span>
            </a>
        </li>

    </ul>
    <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
                <i class="fa fa-fw fa-angle-left"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        {{--            <li class="nav-item dropdown">--}}
        {{--                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"--}}
        {{--                   aria-haspopup="true" aria-expanded="false">--}}
        {{--                    <i class="fa fa-fw fa-envelope"></i>--}}
        {{--                    <span class="d-lg-none">Messages--}}
        {{--              <span class="badge badge-pill badge-primary">12 New</span>--}}
        {{--            </span>--}}
        {{--                    <span class="indicator text-primary d-none d-lg-block">--}}
        {{--              <i class="fa fa-fw fa-circle"></i>--}}
        {{--            </span>--}}
        {{--                </a>--}}
        {{--                <div class="dropdown-menu" aria-labelledby="messagesDropdown">--}}
        {{--                    <h6 class="dropdown-header">New Messages:</h6>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item" href="#">--}}
        {{--                        <strong>David Miller</strong>--}}
        {{--                        <span class="small float-right text-muted">11:21 AM</span>--}}
        {{--                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome!--}}
        {{--                            These messages clip off when they reach the end of the box so they don't overflow over to--}}
        {{--                            the sides!--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item" href="#">--}}
        {{--                        <strong>Jane Smith</strong>--}}
        {{--                        <span class="small float-right text-muted">11:21 AM</span>--}}
        {{--                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00--}}
        {{--                            instead of 4:00. Thanks!--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item" href="#">--}}
        {{--                        <strong>John Doe</strong>--}}
        {{--                        <span class="small float-right text-muted">11:21 AM</span>--}}
        {{--                        <div class="dropdown-message small">I've sent the final files over to you for review. When--}}
        {{--                            you're able to sign off of them let me know and we can discuss distribution.--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item small" href="#">View all messages</a>--}}
        {{--                </div>--}}
        {{--            </li>--}}
        {{--            <li class="nav-item dropdown">--}}
        {{--                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"--}}
        {{--                   aria-haspopup="true" aria-expanded="false">--}}
        {{--                    <i class="fa fa-fw fa-bell"></i>--}}
        {{--                    <span class="d-lg-none">Alerts--}}
        {{--              <span class="badge badge-pill badge-warning">6 New</span>--}}
        {{--            </span>--}}
        {{--                    <span class="indicator text-warning d-none d-lg-block">--}}
        {{--              <i class="fa fa-fw fa-circle"></i>--}}
        {{--            </span>--}}
        {{--                </a>--}}
        {{--                <div class="dropdown-menu" aria-labelledby="alertsDropdown">--}}
        {{--                    <h6 class="dropdown-header">New Alerts:</h6>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item" href="#">--}}
        {{--              <span class="text-success">--}}
        {{--                <strong>--}}
        {{--                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>--}}
        {{--              </span>--}}
        {{--                        <span class="small float-right text-muted">11:21 AM</span>--}}
        {{--                        <div class="dropdown-message small">This is an automated server response message. All systems--}}
        {{--                            are online.--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item" href="#">--}}
        {{--              <span class="text-danger">--}}
        {{--                <strong>--}}
        {{--                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>--}}
        {{--              </span>--}}
        {{--                        <span class="small float-right text-muted">11:21 AM</span>--}}
        {{--                        <div class="dropdown-message small">This is an automated server response message. All systems--}}
        {{--                            are online.--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item" href="#">--}}
        {{--              <span class="text-success">--}}
        {{--                <strong>--}}
        {{--                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>--}}
        {{--              </span>--}}
        {{--                        <span class="small float-right text-muted">11:21 AM</span>--}}
        {{--                        <div class="dropdown-message small">This is an automated server response message. All systems--}}
        {{--                            are online.--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-divider"></div>--}}
        {{--                    <a class="dropdown-item small" href="#">View all alerts</a>--}}
        {{--                </div>--}}
        {{--            </li>--}}
        {{--            <li class="nav-item">--}}
        {{--                <form class="form-inline my-2 my-lg-0 mr-lg-2">--}}
        {{--                    <div class="input-group">--}}
        {{--                        <input class="form-control search-top" type="text" placeholder="Search for...">--}}
        {{--                        <span class="input-group-btn">--}}
        {{--                <button class="btn btn-primary" type="button">--}}
        {{--                  <i class="fa fa-search"></i>--}}
        {{--                </button>--}}
        {{--              </span>--}}
        {{--                    </div>--}}
        {{--                </form>--}}
        {{--            </li>--}}
        {{--            <li class="nav-item">--}}
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>ВЫХОД</a>
        </li>
    </ul>
</div>
