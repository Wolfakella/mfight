@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-offset-2">
		    <h1>Редактирование ситуации</h>
		</div>
    </div>
    <hr/>

    {!! Form::model($situation, [
        'method' => 'PATCH',
        'url' => ['situations', $situation->id],
        'class' => 'form-horizontal'
    ]) !!}
		<div class="row">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Название: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                {!! Form::label('body', 'Ситуация: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : ''}}">
                {!! Form::label('roles', 'Роли и интересы: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('roles', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
       </div>
       <div class="row">
            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                {!! Form::label('link', 'Ссылка: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
		</div>
		<div class="row">
		    <div class="form-group">
		        <div class="col-sm-offset-3 col-sm-3">
		            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary form-control']) !!}
		        </div>
		        <div class="col-sm-3">
		        		<a href="{{ url('situations/' . $situation->id) }}">
		                            <div class="btn btn-default form-control">Отменить</div>
		                </a>
		        </div>
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