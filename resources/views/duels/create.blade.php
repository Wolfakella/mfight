@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-offset-2">
    		<h1>Поединок</h1>
    	</div>
    </div>
    <hr/>
	<div class="row">
		<div class="col-sm-6">
			<form method="POST" action="{{ url('duels') }}">
				{!! csrf_field() !!}
				<input type="hidden" name="champ_id" value="{{$champ->id}}" />
				<label>Тип поединка:</label>
				{{ Form::select('type_id', $types->lists('text', 'id'), $duel->type_id, ['class' => 'form-control']) }}
				<div class="container">
					<div class="row">
						<div class="col-sm-6">					
						<label>Игрок 1:</label>
						{{ Form::select('player1_id', $players->lists('surname', 'id'), $duel->player1_id, ['class' => 'form-control']) }}
						</div>
						<div class="col-sm-6">					
						<label>Результат:</label>
						<select class="form-control" name="result1">
						@for($i=0; $i < 10; $i++)
							@if($duel->result1 == $i)
							<option value="{{$i}}" selected>{{$i}}</option>
							@else
							<option value="{{$i}}">{{$i}}</option>
							@endif
						@endfor
						</select>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-6">					
						<label>Игрок 2:</label>
						{{ Form::select('player2_id', $players->lists('surname', 'id'), $duel->player2_id, ['class' => 'form-control']) }}
						</div>
						<div class="col-sm-6">					
						<label>Результат:</label>
						<select class="form-control" name="result2">
						@for($i=0; $i < 10; $i++)
							@if($duel->result2 == $i)
							<option value="{{$i}}" selected>{{$i}}</option>
							@else
							<option value="{{$i}}">{{$i}}</option>
							@endif
						@endfor
						</select>
						</div>
					</div>
				</div>
				<label>Ситуация:</label>
				{{ Form::select('situation_id', $situations->lists('title', 'id'), $duel->situation_id, ['class' => 'form-control']) }}
				<label>Видео</label>
				<textarea rows="5" cols="30" name="video" class="form-control"></textarea>
				<label>Дата и время: </label>
				<input type="datetime" name="time" class="form-control" value="{{$duel->time}}" />
				<label>Номер поединка: </label>
				<input type="text" name="order" class="form-control" value="{{$duel->order}}" />
				<input type="submit" value="Сохранить" class="btn btn-primary" />
				<a href="" class="btn btn-default">Назад</a>
			</form>
		</div>
	</div>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection