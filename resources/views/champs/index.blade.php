@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
    Чемпионаты
    <div class="pull-right">
    <a href="{{ url('cart/flush') }}" class="btn btn-default btn-sm">Очистить корзину</a>
    <a href="{{ url('cart/print') }}" id="popup" class="btn btn-primary btn-sm">Распечатать ситуации</a>
    </div>
    </h1>
    @if(!empty($champs))
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Название</th><th>Год</th><th>Действия</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            
            @foreach($champs as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('champs/', $item->id) }}">{{ $item->title }}</a></td>
                    <td>{{ $item->created_at->format('Y') }}</td>
                    <td>
                    	<form method="POST" action="{{ url('champs/' . $item->id) }}">
                    		<input name="_method" type="hidden" value="DELETE">
                    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger btn-xs">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
        </table>
    </div>
    @else
    <h4>В данный момент соревнований по Управленческой борьбе нет!</h4>
    @endif
</div>
@endsection
