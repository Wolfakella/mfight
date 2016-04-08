@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h2>
                	{{ $situation->title }}
                	    <div class="pull-right">
					    <a href="{{ url('situations/year/'. $situation->created_at->format('Y')) }}" class="btn btn-default btn-sm">К {{ $situation->created_at->format('Y') }} году</a>
					    @if($cart)
                            <button type="submit" class="btn btn-default btn-sm disabled">В корзине</button>
                		@else
					    <a href="{{ url( 'cart/add/' . $situation->id ) }}" class="btn btn-primary btn-sm">Добавить в корзину</a>
                    	@endif
					    </div>
                	</h2>
                	@role('admin')
                	<a href="{{ url( ($situation->roles ? 'situations/' : 'express/') . $situation->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Редактировать</button>
                    </a>
                    @endrole
                </div>
                <div class="panel-body">
                    <p>{!! $situation->body !!}</p>
                    @if($situation->roles)
                    	<h3>Роли и интересы:</h3>
                    	{!! $situation->roles !!}
                    @endif
                    <a href="{{ $situation->link }}">Ссылка на источник</a>
                    <div class="pull-right">
                    @role('admin')
					{!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['situations', $situation->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-xs']) !!}
                     {!! Form::close() !!}
                     @endrole
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection