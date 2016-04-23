@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
			<form role="form" method="GET" action="{{ url('/champs/'.$champ_id.'/situations') }}">
	            <div class="col-xs-4">
	            	<input class="form-control" type="text" name="query" placeholder="Название ситуа..." value="{{ $query or '' }}" />
	            </div>
	            <div class="col-xs-3">
		            <select class="form-control" name="year">
		            	<option value="0">Любой год</option>
		            	@for($i=2001; $i<2017; $i++)
		            		@if(!empty($year) && $i == $year)
		            		<option value="{{ $i }}" selected>{{ $i }}</option>
		            		@else
		            		<option value="{{ $i }}">{{ $i }}</option>
		            		@endif
		            	@endfor
		            </select>
	            </div>
	            <div class="col-xs-3">
		            <select class="form-control" name="t">
		            	<option value="0" @if(!empty($t) && $t == 0) selected @endif>Быстрые и классические</option>
		            	<option value="1" @if(!empty($t) && $t == 1) selected @endif>Быстрые</option>
		            	<option value="2" @if(!empty($t) && $t == 2) selected @endif>Классические</option>
		            </select>
		        </div>
		        <div class="col-xs-1">
	            	<input class="btn btn-primary" type="submit" value="Отфильтровать" />
	            </div>
            </form>
     </div>

    <h1>Ситуации <a href="{{ route('champ.show', [$champ_id]) }}" class="btn btn-primary pull-right btn-sm">Вернуться к Чемпионату</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Название</th><th>Год</th><th>Действия</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($situations as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('situations', $item->id) }}">{{ $item->title }}</a></td>
                    <td>{{ $item->created_at->format('Y') }}</td>
                    <td>
                    	@if($champ_situations->contains($item))               		
                        <button type="submit" class="btn btn-default btn-xs">Добавлена в турнир</button>
                        @else
                        <a href="{{ route('champ.addsituation', [$champ_id, $item->id]) }}" class="btn btn-primary btn-xs">Добавить</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination"> {!! $situations->appends(request()->all())->render() !!} </div>
</div>
@endsection
