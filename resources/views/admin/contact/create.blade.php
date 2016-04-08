@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Création d'un organisme</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    {!! Form::open(['route' => 'admin.contact.store', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('presentation') ? 'has-error' : '' !!}">
                        {!! Form::text('presentation', null, ['class' => 'form-control', 'placeholder' => 'Présentation']) !!}
                        {!! $errors->first('presentation', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!}">
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
                        {!! $errors->first('address', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('postal_code') ? 'has-error' : '' !!}">
                        {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
                        {!! $errors->first('postal_code', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('locality') ? 'has-error' : '' !!}">
                        {!! Form::text('locality', null, ['class' => 'form-control', 'placeholder' => 'Commune']) !!}
                        {!! $errors->first('locality', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('country') ? 'has-error' : '' !!}">
                        {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Pays']) !!}
                        {!! $errors->first('country', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('categorie') ? 'has-error' : '' !!}">
                        {!! Form::text('categorie', null, ['class' => 'form-control', 'placeholder' => 'Categorie']) !!}
                        {!! $errors->first('categorie', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
                        {!! $errors->first('phone', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('phone2') ? 'has-error' : '' !!}">
                        {!! Form::text('phone2', null, ['class' => 'form-control', 'placeholder' => 'Téléphone2']) !!}
                        {!! $errors->first('phone2', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('website') ? 'has-error' : '' !!}">
                        {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Site web']) !!}
                        {!! $errors->first('website', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
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
@stop
