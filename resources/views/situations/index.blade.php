@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
			<form role="form" method="GET" action="{{ url('/situations/search') }}">
	            
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

    <h1>Ситуации <a href="{{ url('situations/create') }}" class="btn btn-primary pull-right btn-sm">Добавить ситуацию</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Название</th><th>Год</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($situations as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('situations', $item->id) }}">{{ $item->title }}</a></td>
                    <td>{{ $item->created_at->format('Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination"> {!! $situations->appends(request()->all())->render() !!} </div>
</div>
@endsection
