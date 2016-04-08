@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
    Корзина
    <div class="pull-right">
    <a href="{{ url('cart/flush') }}" class="btn btn-default btn-sm">Очистить корзину</a>
    <!-- <a href="{{ url('cart/print') }}" class="btn btn-primary btn-sm">Распечатать ситуации</a> -->
    </div>
    </h1>
    @if(!empty($situations))
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Название</th><th>Год</th><th>Действия</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            
            @foreach($situations as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('situations', $item->id) }}">{{ $item->title }}</a></td>
                    <td>{{ $item->created_at->format('Y') }}</td>
                    <td>
                        <a href="{{ url('cart/remove/' . $item->id ) }}">
                            <button type="submit" class="btn btn-danger btn-xs">Удалить из корзины</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
        </table>
    </div>
    @else
    <h4>В вашей корзине пусто!</h4>
    @endif
</div>
@endsection
