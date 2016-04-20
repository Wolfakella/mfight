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
			<form method="POST" action="{{ url('champs/'.$champ->id.'/newduel') }}">
				{!! csrf_field() !!}
				<label>Тип поединка:</label>
				<select class="form-control" name="type_id">
				@foreach($types as $type)
					<option value="{{ $type->id }}">{{ $type->text }}</option>
				@endforeach
				</select>
				<div class="container">
					<div class="row">
						<div class="col-sm-6">					
						<label>Игрок 1:</label>
						<select class="form-control" name="player1_id">
							@foreach($players as $player)
								<option value="{{ $player->id }}">{{ $player->surname }} {{ $player->name }}</option>
							@endforeach	
						</select>
						</div>
						<div class="col-sm-6">					
						<label>Результат:</label>
						<select class="form-control" name="result1">
						@for($i=0; $i < 10; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
						</select>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-6">					
						<label>Игрок 2:</label>
						<select class="form-control" name="player2_id">
							@foreach($players as $player)
								<option value="{{ $player->id }}">{{ $player->surname }} {{ $player->name }}</option>
							@endforeach	
						</select>
						</div>
						<div class="col-sm-6">					
						<label>Результат:</label>
						<select class="form-control" name="result2">
						@for($i=0; $i < 10; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
						</select>
						</div>
					</div>
				</div>
				<label>Ситуация:</label>
				<select class="form-control" name="situation_id">
				@foreach($situations as $situation)
					<option value="{{ $situation->id }}">{{ $situation->title }}</option>
				@endforeach
				</select>
				<label>Дата и время: </label>
				<input type="datetime" name="time" class="form-control" />
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