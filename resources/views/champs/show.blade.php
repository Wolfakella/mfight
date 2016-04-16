@extends('layouts.app')

@section('content')
<div class="container">
	<h2>{{ $champ->title }}</h2>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>
				Поединки
				</h3></div>
				<div class="panel-body">
				
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
