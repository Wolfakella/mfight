@extends('layouts.app')

@section('content')
<div class="container">
	<h1>{{$user->name}} {{$user->middlename}} {{$user->surname}}</h1>
	<br />
	<div class="row">
		<div class="col-sm-3 vcenter">
			<img src="{{ asset('images/placeholder.png')}}" class="image-responsive" />
       	</div>
       	<div class="col-sm-6 vcenter">
       		<dl class="dl-horizontal">
			  	<dt>Компания</dt>
			  	<dd>{{$user->company}}</dd>
			  	<dt>Должность</dt>
			  	<dd>{{$user->position}}</dd>
			  	@role('admin')
			  	<dt>Телефон</dt>
			  	<dd>{{$user->phone}}</dd>
			  	<dt>Email</dt>
			  	<dd>{{$user->email}}</dd>
			  	@endrole
			</dl>
       	</div>
    </div>
</div>
@endsection