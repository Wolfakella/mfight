@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-offset-2">
    		<h1>Добавление ситуации</h1>
    	</div>
    </div>
    <hr/>

    {!! Form::open(['url' => 'situations', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Название: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                {!! Form::label('body', 'Ситуация: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                {!! Form::label('link', 'Ссылка: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class="col-sm-3">
        		<a href="{{ $back }}">
                            <div class="btn btn-default form-control">Отменить</div>
                </a>
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