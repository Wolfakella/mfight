@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			<h3>Чемпионаты</h3>
			</div>
			<div class="panel-body">
			@foreach($champs as $champ)
				<a href="{{ route('champ.show', [$champ->id]) }}" class="lead">{{ $champ->title }}</a>
			@endforeach
			</div>
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-heading">
			<h3>3 поединка</h3>
			</div>
			<div class="panel-body text-center">
			@foreach($duels as $duel)
					<!-- <p><a href="{{route('champ.show', [$duel->champ_id])}}">{{$duel->champ->title}}</a><br />{{ $duel->type->text }}
					<br /> 
					<small>{{ $duel->time->format('d.m.Y, H:i') }}</small>
					</p> -->
					@if($duel->video)
					<a href="{{ url('duels/'.$duel->id) }}" class="btn btn-success btn-xs">Доступно видео!</a>
					@else
					<a href="{{ url('duels/'.$duel->id) }}" class="btn btn-primary btn-xs">Подробнее</a>
					@endif
					<table width="100%">
					<tr>
					<td  width="40%">
					<a href="{{ url('users/'.$duel->player1_id) }}">{{ $duel->player1->name }} {{ $duel->player1->surname }}</a>
					</td>
					<td width="20%">
					<h3>{{ $duel->result1 }} : {{ $duel->result2 }}</h3>
					</td>
					<td width="40%">
					<a href="{{ url('users/'.$duel->player2_id) }}">{{ $duel->player2->name }} {{ $duel->player2->surname }}</a>
					</td>
					</tr>
					</table>
					<strong>Ситуация: </strong>
					<a href="{{ url('situations/'.$duel->situation_id) }}">{{ $duel->situation->title }}</a>
					<hr />
				@endforeach
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-heading">
			<h3>5 участников</h3>
			</div>
			<div class="panel-body">
			@foreach($players as $player)
				<h3><a href="{{ route('user.show', [$player->id]) }}">{{ $player->name }} {{ $player->surname }}</a></h3>
			@endforeach
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-heading">
			<h3>1 ситуация</h3>
			</div>
			<div class="panel-body">
			<h4><a href="{{ route('situations.show', [$situation->id])}}">{{ $situation->title }}</a></h4>
			{!! substr($situation->body, 0, 1300).'...' !!}
			</div>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Добро пожаловать!</h3></div>

                <div class="panel-body">
					<p>На этом сайте вы найдете ситуации, разыгрываемые на Чемпионатах по управленческой борьбе с 2001 года.</p>
					<p>Авторские права на технологию "Управленческий поединок" принадлежат Владимиру Константиновичу Тарасову. Не забудьте посетить сайт Таллиннской школы менеджмента <a href="http://www.tarasov.ru/">www.tarasov.ru</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
