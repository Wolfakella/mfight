@extends('layouts.app')

@section('content')
<div class="container">
	<h2>{{ $champ->title }}</h2>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>
				Поединки
				<a href="{{ url('champs/'.$champ->id.'/newduel') }}" class="btn btn-primary btn-sm">Добавить</a>
				</h3></div>
				<div class="panel-body text-center">
				@if($duels)
				@foreach($duels as $duel)
					<h4>{{ $duel->type->text }}.</h4>
					<p class="lead"><a href="{{ url('users/'.$duel->player1) }}">{{ $duel->player1->name }} {{ $duel->player1->surname }}</a> 
					<strong>{{ $duel->result1 }} : {{ $duel->result2 }}</strong>
					<a href="{{ url('users/'.$duel->player2) }}">{{ $duel->player2->name }} {{ $duel->player2->surname }}</a>
					</p>
					<strong>Ситуация: </strong>
					<a href="{{ url('situations/'.$duel->situation_id) }}">{{ $duel->situation->title }}</a>
					<form method="POST" action="{{ url('champs/'.$champ->id.'/removeduel/'.$duel->id) }}">
						<input type="hidden" name="_method" value="DELETE" />
						{!! csrf_field() !!}
						<input type="submit" value="Удалить" class="btn btn-danger" />
					</form>
					<hr />
				@endforeach
				@endif
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>
				Игроки
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				</h4></div>
				<div class="panel-body">
				@if($players)
				<ol>
				@foreach($players as $player)
					<li>
						<a href="{{url('users/'.$player->id)}}">{{$player->name}} {{$player->surname}}</a>
						<a href="{{ url('champs/'.$champ->id.'/remove/'.$player->id) }}" class="btn btn-danger btn-xs">Удалить</a>
					</li>
				@endforeach
				</ol>
				@else
				<p>В этот турнир еще не добавлено ни одного игрока!</p>
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endif
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h4>
				Ситуации
				<a href="{{ url('champs/'.$champ->id.'/situations') }}" class="btn btn-primary btn-sm">Добавить</a>
				</h4></div>
				<div class="panel-body">
				@if($situations)
				<ol>
				@foreach($situations as $situation)
					<li>
						<a href="{{url('situations/'.$situation->id)}}">{{$situation->title}}</a>
						<a href="{{ url('champs/'.$champ->id.'/situationremove/'.$situation->id) }}" class="btn btn-danger btn-xs">Удалить</a>
					</li>
				@endforeach
				</ol>
				@else
				<p>В этот турнир еще не добавлено ни одной ситуации!</p>
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endif
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h4>
				Судьи
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				</h4></div>
				<div class="panel-body">
				@if($judges)
				<ol>
				@foreach($judges as $judge)
					<li>
						<a href="{{url('users/'.$judge->id)}}">{{$judge->name}} {{$judge->surname}}</a>
						<a href="{{ url('champs/'.$champ->id.'/remove/'.$judge->id) }}" class="btn btn-danger btn-xs">Удалить</a>
					</li>
				@endforeach
				</ol>
				@else
				<p>В этот турнир еще не добавлено ни одного игрока!</p>
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endif
				</div>
			</div>		
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-12">
					
		</div>
	</div>
</div>
@endsection
