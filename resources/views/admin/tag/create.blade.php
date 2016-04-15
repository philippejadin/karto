@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Création d'un tag</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    {!! Form::open(['route' => 'admin.tag.store', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('color') ? 'has-error' : '' !!}">
                        {!! Form::text('color', null, ['id' => 'color', 'class' => 'form-control', 'placeholder' => 'Couleur']) !!}
                        {!! $errors->first('color', '<small class="help-block">:message</small>') !!}
                    </div>

                    {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.css' />

    <script>
        $("#color").spectrum({
            preferredFormat: "hex"
        });

    </script>

@stop
