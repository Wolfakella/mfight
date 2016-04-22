@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Участники 
    @role('admin')
    <a href="{{ url('users/create') }}" class="btn btn-primary pull-right btn-sm">Добавить участника</a>
    @endrole
    </h1>

            {{-- */$x=0;/* --}}
            @foreach($users as $item)
            {{-- */$x++;/* --}}
            <div class="row">
            	<div class="col-md-1">{{-- $item->id --}}</div>
            	<div class="col-md-5">
                    <p><a href="{{ url('users', $item->id) }}">{{ $item->surname }} {{ $item->name }} {{ $item->middlename }}</a></p>
               		<p>{{ $item->position }} {{ $item->company }} {{ $item->about }}</p>
                </div>
                @role('admin')
                <div class="col-md-2">{{ $item->email }}</div>
                <div class="col-md-2">+7{{ $item->phone }}</div>
                <div class="col-md-2">
                		<a href="{{ url('users/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Редактировать</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['users', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                </div>
                @endrole
            </div>
            <hr />
            @endforeach
        <div class="pagination"> {!! $users->render() !!} </div>
</div>
@endsection
