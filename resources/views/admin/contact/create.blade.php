@extends('layouts.app')

@section('content')

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

    <div class="container">
        <h1>Création d'un contact</h1>


        {!! Form::model($contact, ['route' => ['admin.contact.store'], 'method' => 'post', 'class' => 'form-horizontal panel']) !!}

        @include ('admin.contact.form')



        {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
        {!! Form::close() !!}

    </div>
@stop
