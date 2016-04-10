@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users <a href="{{ url('users/create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a></h1>
            @foreach($users as $item)
            @if(!$champ_users->contains($item)) 
            <div class="row">
            	<div class="col-md-1">{{-- $item->id --}}</div>
            	<div class="col-md-5">
                    <p><a href="{{ url('users', $item->id) }}">{{ $item->surname }} {{ $item->name }} {{ $item->middlename }}</a></p>
               		<p>{{ $item->position }} {{ $item->company }} {{ $item->about }}</p>
                </div>
                <div class="col-md-2">{{ $item->email }}</div>
                <div class="col-md-2">+7{{ $item->phone }}</div>
                <div class="col-md-2">
                		@if($champ_users->contains($item))               		
                        <button type="submit" class="btn btn-default btn-xs">Добавлен в турнир</button>
                        @else
                        <a href="{{ Request::fullUrl() .'/'. $item->id . '/1' }}">
                            <button type="submit" class="btn btn-primary btn-xs">Добавить Игрока</button>
                        </a>
                        <a href="{{ Request::fullUrl() .'/'. $item->id . '/2' }}">
                            <button type="submit" class="btn btn-primary btn-xs">Добавить Судью</button>
                        </a>
                        @endif
                </div>
            </div>
            <hr />
            @endif
            @endforeach
</div>
@endsection
