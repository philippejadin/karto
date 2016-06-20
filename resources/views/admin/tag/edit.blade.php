@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Modification d'un tag</h1>
        {!! Form::model($tag, ['route' => ['admin.tag.update', $tag->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}

        @include ('admin.tag.form')

        {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}

    </div>
@stop
