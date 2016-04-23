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
					    <!--<a href="{{ url('situations/year/'. $situation->created_at->format('Y')) }}" class="btn btn-default btn-sm">К {{ $situation->created_at->format('Y') }} году</a>-->
					    <a href="{{ url()->previous() }}" class="btn btn-default btn-sm">Назад</a>
					    @if($cart)
                            <button type="submit" class="btn btn-default btn-sm disabled">В корзине</button>
                		@else
					    <a href="{{ url( 'cart/add/' . $situation->id ) }}" class="btn btn-primary btn-sm">Добавить в корзину</a>
                    	@endif
					    </div>
                	</h2>
                	<div class="fb-like" data-href="{{ route('situations.show', [$situation->id]) }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
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
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
    		<div class="panel panel-default">
    			<div class="panel-heading"><h4>
					История поединков
					</h3>
				</div>
				<div class="panel-body text-center">
				@if($history && !$history->isEmpty())
				@foreach($history as $duel)
					<h4><a href="{{route('champ.show', [$duel->champ_id])}}">{{$duel->champ->title}}</a><br />{{ $duel->type->text }}
					<br /> 
					<small>{{ $duel->time->format('d.m.Y, H:i') }}</small>
					</h4>
					@if($duel->video)
					<a href="{{ url('duels/'.$duel->id) }}" class="btn btn-success btn-xs">Доступно видео!</a>
					@else
					<a href="{{ url('duels/'.$duel->id) }}" class="btn btn-primary btn-xs">Подробнее</a>
					@endif
					<table width="100%">
					<tr>
					<td  width="40%">
					<a href="{{ url('users/'.$duel->player1_id) }}" class="lead">{{ $duel->player1->name }} {{ $duel->player1->surname }}</a>
					</td>
					<td width="20%">
					<h3>{{ $duel->result1 }} : {{ $duel->result2 }}</h3>
					</td>
					<td width="40%">
					<a href="{{ url('users/'.$duel->player2_id) }}" class="lead">{{ $duel->player2->name }} {{ $duel->player2->surname }}</a>
					</td>
					</tr>
					</table>
					<strong>Ситуация: </strong>
					<a href="{{ url('situations/'.$duel->situation_id) }}">{{ $duel->situation->title }}</a>
					<hr />
				@endforeach
				@endif
				</div>
				</div>
		    	</div>
    		</div>
    	</div>
    </div>
</div>
@endsection