@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
			<form role="form" method="POST" action="{{ url('/champs/'.$champ.'/situations') }}">
	            {!! csrf_field() !!}
	            <div class="col-xs-4">
	            	<input class="form-control" type="text" name="query" placeholder="Введите запрос" />
	            </div>
	            <div class="col-xs-3">
		            <select class="form-control" name="year">
		            	<option value="0">Любой</option>
		            	@for($i=2001; $i<2017; $i++)
		            	<option value="{{ $i }}">{{ $i }}</option>
		            	@endfor
		            </select>
	            </div>
	            <div class="col-xs-3">
		            <select class="form-control" name="t">
		            	<option value="0">Любая</option>
		            	<option value="1">Быстрая</option>
		            	<option value="2">Классическая</option>
		            </select>
		        </div>
		        <div class="col-xs-1">
	            	<input class="btn btn-primary" type="submit" value="Отфильтровать" />
	            </div>
            </form>
     </div>

    <h1>Ситуации <a href="{{ url('situations/create') }}" class="btn btn-primary pull-right btn-sm">Добавить ситуацию</a></h1>
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
                        <a href="{{ Request::fullUrl() .'/'. $item->id }}">
                            <button type="submit" class="btn btn-primary btn-xs">Добавить</button>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection