<?php
/**
 * @var \App\Models\Sms\Sms $activationCode
 */

?>

@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('sms.index')}}">Доска</a>
                </li>
                <li class="breadcrumb-item active">Смс коды</li>
            </ol>

            <!-- /cards -->
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-fw fa-list"></i>Смс коды</h2>
                    <div class="pull-right">
{{--                        <a href="{{route('sms.create')}}" class="btn badge-primary">Добавить</a>--}}
                    </div>
                </div>

                <div class="options">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Логин</th>
                            <th>Код</th>
                            <th>Создано</th>
{{--                            <th>Удалить</th>--}}
                            <th>Действия</th>
                        </tr>

                        @foreach($activationCodes as $activationCode)
                            <tr>
                                <td>
                                    {{$activationCode->login}}
                                </td>
                                <td>
                                    {{$activationCode->code}}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($activationCode->created_at)->format('d.m.Y H:i:s') }}
                                </td>

                                @if( strlen($activationCode->code) !== 4 )
                                <td>
                                    <form style="display: inline" action="{{ route('sms.destroy', $activationCode->created_at) }}" method="POST"
                                          class="{{"form-" . $activationCode->login}}">
                                        {!! method_field('DELETE') !!}
                                        @csrf
                                        <button style="border: none; background: none;" type="submit" onclick="return confirm('Вы уверены?')"><a
                                                href="javascript:void(0)"></a>
                                        </button>
                                    </form>
                                </td>
                                @endif

                                @if( strlen($activationCode->code) === 4 )
                                <td>
                                    <form style="display: inline" action="{{ route('admin.sms.activate1', $activationCode->created_at) }}" method="POST"
                                          class="{{"form-" . $activationCode->login}}">
{{--                                        {!! method_field('DELETE') !!}--}}
                                        @csrf
                                        <button style="border: none; background: none;" type="submit" onclick="return confirm('Вы уверены?')"><a
                                                href="javascript:void(0)"><b>Активировать</b></a>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection



