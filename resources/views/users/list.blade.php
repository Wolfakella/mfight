@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users <a href="{{ url('users/create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a></h1>

            {{-- */$x=0;/* --}}
            @foreach($users as $item)
            {{-- */$x++;/* --}}
            <div class="row">
            	<div class="col-md-1">{{-- $item->id --}}</div>
            	<div class="col-md-5">
                    <p><a href="{{ url('users', $item->id) }}">{{ $item->surname }} {{ $item->name }} {{ $item->middlename }}</a></p>
               		<p>{{ $item->position }} {{ $item->company }} {{ $item->about }}</p>
                </div>
                <div class="col-md-2">{{ $item->email }}</div>
                <div class="col-md-2">+7{{ $item->phone }}</div>
                <div class="col-md-2">
                		<a href="{{ url('users/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['users', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                </div>
            </div>
            <hr />
            @endforeach
        <div class="pagination"> {!! $users->render() !!} </div>
</div>
@endsection
