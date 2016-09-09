@extends('layouts.app')

@section('content')

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

    <div class="container">

        <h1>Modification d'un utilisateur</h1>

        {!! Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}

        @include ('admin.user.form')


        {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}

    </div>
@stop
