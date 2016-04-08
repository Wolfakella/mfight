@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Ситуации <a href="{{ url(($situations[0]->roles ? 'situations' : 'express').'/create') }}" class="btn btn-primary pull-right btn-sm">Добавить ситуацию</a></h1>
    		<h3>{{ $situations[0]->created_at->format('Y') }}</h3>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
		    <ol>
		    	@foreach($situations as $item)
		    	<li><a href="{{ url('situations', $item->id) }}">{{ $item->title }}</a></li>
		    	@endforeach
		    </ol>
		</div>
    </div>
</div>
@endsection
