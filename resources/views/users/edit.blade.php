@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <hr/>

    {!! Form::model($user, [
        'method' => 'PATCH',
        'url' => ['users', $user->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('middlename') ? 'has-error' : ''}}">
                {!! Form::label('middlename', 'Middlename: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('middlename', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('middlename', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('surname') ? 'has-error' : ''}}">
                {!! Form::label('surname', 'Surname: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('surname', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                {!! Form::label('phone', 'Phone: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
                {!! Form::label('position', 'Position: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('position', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
                {!! Form::label('company', 'Company: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('company', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('about') ? 'has-error' : ''}}">
                {!! Form::label('about', 'About: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('about', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('about', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('login') ? 'has-error' : ''}}">
                {!! Form::label('login', 'Login: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('login', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('login', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection