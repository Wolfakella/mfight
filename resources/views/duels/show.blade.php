@extends('layouts.app')

@section('content')
<div class="container">
	<h2>{{ $duel->champ->title}}</h2>
	<h4>{{ $duel->type->text }} <small>{{ $duel->time->format('d.m.Y, H:i') }}</small></h4>
	
	<div class="row">
		<iframe width="560" height="315" src="https://www.youtube.com/embed/ud5exxtBQeA" frameborder="0" allowfullscreen></iframe>
       	<div class="col-sm-5">
       		<div class="panel panel-default">
       			<div class="panel-heading">
					<h3>Информация</h3>
				</div>
				<div class="panel-body text-center">
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
				</div>
			</div>
       	</div>
    </div>
</div>
@endsection