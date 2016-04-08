@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h2>
                	{{ $situation->title }}
                	@if($cart)
                            <button type="submit" class="btn btn-default btn-xs">В корзине</button>
                	@else
                	<a href="{{ url( 'cart/add/' . $situation->id ) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Добавить в корзину</button>
                    </a>
                    @endif
                	</h2>
                	@role('admin')
                	<a href="{{ url( ($situation->roles ? 'situations/' : 'express/') . $situation->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Редактировать</button>
                    </a>
                     {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['situations', $situation->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-xs']) !!}
                     {!! Form::close() !!}
                     @endrole
                </div>
                <div class="panel-body">
                    <p>{!! $situation->body !!}</p>
                    @if($situation->roles)
                    	<h3>Роли и интересы:</h3>
                    	{!! $situation->roles !!}
                    @endif
                    <a href="{{ $situation->link }}">Ссылка на источник</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection