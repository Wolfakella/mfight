@extends('layouts.app')

@section('content')
<div class="container">
	<h2><a href="{{ route('champ.show', [$duel->champ_id]) }}">{{ $duel->champ->title}}</a></h2>
	<h4>{{ $duel->type->text }} <small>{{ $duel->time->format('d.m.Y, H:i') }}</small>
		<div class="fb-like pull-right" data-href="{{ route('duels.show', [$duel->id]) }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
	</h4>
	
	<div class="row">
		@if($duel->video)
		<div class="col-sm-6">
			{!! $duel->video !!}
			
		</div>
		@endif
		
       	<div class="col-sm-6">
       		<div class="panel panel-default">
       			<div class="panel-heading">
					<h3>Информация</h3>
				</div>
				<div class="panel-body text-center">
					<table width="100%">
					<tr>
					<td  width="40%">
					<a href="{{ url('users/'.$duel->player1_id) }}" class="lead">{{ $duel->player1->name }} {{ $duel->player1->surname }}</a>
					<br/>
					<small>Рейтинг: {{ $duel->rating1 }}</small>
					</td>
					<td width="20%">
					<h3>{{ $duel->result1 }} : {{ $duel->result2 }}</h3>
					</td>
					<td width="40%">
					<a href="{{ url('users/'.$duel->player2_id) }}" class="lead">{{ $duel->player2->name }} {{ $duel->player2->surname }}</a>
					<br/>
					<small>Рейтинг: {{ $duel->rating2 }}</small>
					</td>
					</tr>
					</table>
					<strong>Ситуация: </strong>
					<a href="{{ url('situations/'.$duel->situation_id) }}">{{ $duel->situation->title }}</a>
					<hr />
				</div>
			</div>
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
				@else
				<h4>Пока это единственный поединок между данными игроками. Но то ли еще будет! =)</h4>
				@endif
				</div>
		</div>
       	</div>
       	<div class="col-sm-6">
       		<div class="fb-comments" data-href="{{ route('duels.show', [$duel->id]) }}" data-numposts="5"></div>
    	</div>
    </div>
</div>
@endsection