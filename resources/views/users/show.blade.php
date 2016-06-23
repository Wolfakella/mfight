@extends('layouts.app')

@section('content')
<div class="container">
	<h1 class="col-sm-offset-2">{{$user->name}} {{$user->middlename}} {{$user->surname}}</h1>
	<br />
	<div class="row">
		<div class="col-sm-offset-2 col-sm-3 vcenter">
			<img src="{{ asset('images/placeholder.png')}}" class="image-responsive" />
       	</div>
       	<div class="col-sm-5 vcenter">
       		<dl class="dl-horizontal">
			  	<dt>Компания</dt>
			  	<dd>{{$user->company}}</dd>
			  	<dt>Должность</dt>
			  	<dd>{{$user->position}}</dd>
			  	<dt>Рейтинг</dt>
			  	<dd><strong class="text-success">{{$user->rating}}</strong></dd>
			  	@role('admin')
			  	<dt>Телефон</dt>
			  	<dd>{{$user->phone}}</dd>
			  	<dt>Email</dt>
			  	<dd>{{$user->email}}</dd>
			  	@endrole
			</dl>
       	</div>
    </div>
    <br />
    <div class="row">
    	<div class="col-sm-offset-2 col-sm-8">
    	<div class="panel panel-default">
	    		<div class="panel-heading"><h4>
					История поединков
					</h3>
				</div>
				<div class="panel-body text-center">
				@if($duels)
				@foreach($duels as $duel)
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
				@endforeach
				@endif
				</div>
		</div>
    	</div>
    </div>
</div>
@endsection