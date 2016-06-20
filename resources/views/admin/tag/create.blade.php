@extends('layouts.app')

@section('content')


    <div class="container">
        <h1>Création d'un tag</h1>

        {!! Form::open(['route' => 'admin.tag.store', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}

        @include ('admin.tag.form')

        {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}

    </div>
@stop
