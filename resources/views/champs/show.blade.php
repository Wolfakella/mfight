@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row text-center">
	<h2 class="col-md-offset-2 col-md-8">{{ $champ->title }}</h2>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Турнирная таблица</div>
		<div id="main" class="panel-body">
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>
				Поединки
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/newduel') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
				<div class="fb-like pull-right" data-href="{{ route('champ.show', [$champ->id]) }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				</h3>
				</div>
				<div class="panel-body text-center">
				@if($duels)
				@foreach($duels as $duel)
					<h4>{{ $duel->type->text }}. <small>№{{ $duel->order }} {{ $duel->time->format('d.m.Y, H:i') }}</small></h4>
					@if($duel->video)
					<a href="{{ url('duels/'.$duel->id) }}" class="btn btn-success btn-xs">Доступно видео!</a>
					@else
					<a href="{{ url('duels/'.$duel->id) }}" class="btn btn-primary btn-xs">Подробнее</a>
					@endif
					<table width="100%">
					<tr>
					<td  width="40%">
					<a href="{{ url('users/'.$duel->player1_id) }}" class="lead">{{ $duel->player1->name }} {{ $duel->player1->surname }}</a>
					<br />
					<small>Рейтинг: {{ $duel->rating1 }}</small>
					</td>
					<td width="20%">
					<h3>{{ $duel->result1 }} : {{ $duel->result2 }}</h3>
					</td>
					<td width="40%">
					<a href="{{ url('users/'.$duel->player2_id) }}" class="lead">{{ $duel->player2->name }} {{ $duel->player2->surname }}</a>
					<br />
					<small>Рейтинг: {{ $duel->rating2 }}</small>
					</td>
					</tr>
					</table>
					<strong>Ситуация: </strong>
					<a href="{{ url('situations/'.$duel->situation_id) }}">{{ $duel->situation->title }}</a>
					@role('admin')
					<form method="POST" action="{{ url('duels/'.$duel->id) }}">
						<input type="hidden" name="_method" value="DELETE" />
						{!! csrf_field() !!}
						<a href="{{ url('duels/'.$duel->id.'/edit') }}" class="btn btn-default">Редактировать</a>
						<input type="submit" value="Удалить" class="btn btn-danger" />
					</form>
					@endrole
					<hr />
				@endforeach
				@endif
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>
				Игроки
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
				</h4></div>
				<div class="panel-body">
				@if($players)
				<table width="100%" cellpadding="10" class="table table-striped">
				@foreach($players as $player)
					<tr>
						<td><a href="{{url('users/'.$player->id)}}">{{$player->name}} {{$player->surname}}</a></td>
						<td>
						@role('admin')
						<a href="{{ url('champs/'.$champ->id.'/remove/'.$player->id) }}" class="btn btn-danger btn-xs">Удалить</a>
						@endrole
						</td>
					</tr>
				@endforeach
				</table>
				@else
				<p>В этот турнир еще не добавлено ни одного игрока!</p>
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
				@endif
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h4>
				Ситуации
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/situations') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
				</h4></div>
				<div class="panel-body">
				@if($situations)
				<ol>
				@foreach($situations as $situation)
					<li>
						<a href="{{url('situations/'.$situation->id)}}">{{$situation->title}}</a>
						@role('admin')
						<a href="{{ url('champs/'.$champ->id.'/situationremove/'.$situation->id) }}" class="btn btn-danger btn-xs">Удалить</a>
						@endrole
					</li>
				@endforeach
				</ol>
				@else
				<p>В этот турнир еще не добавлено ни одной ситуации!</p>
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
				@endif
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h4>
				Судьи
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
				</h4></div>
				<div class="panel-body">
				@if($judges)
				<table class="table table-striped" width="100%">
				@foreach($judges as $judge)
					<tr>
						<td><a href="{{url('users/'.$judge->id)}}">{{$judge->name}} {{$judge->surname}}</a></td>						
						<td>
						@role('admin')
						<a href="{{ url('champs/'.$champ->id.'/remove/'.$judge->id) }}" class="btn btn-danger btn-xs">Удалить</a>
						@endrole
						</td>
					</tr>
				@endforeach
				</table>
				@else
				<p>В этот турнир еще не добавлено ни одного игрока!</p>
				@role('admin')
				<a href="{{ url('champs/'.$champ->id.'/players') }}" class="btn btn-primary btn-sm">Добавить</a>
				@endrole
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
