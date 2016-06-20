@extends('layouts.app')

@section('content')

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

    <div class="container">



        <h1>Exportation d'organisme</h1>

        {!! Form::open(['action' =>'ExportController@export']) !!}


        <div class="form-group">
            Choisissez un ou plusieurs tags à exporter :
            {!! Form::select('tags[]', App\Tag::pluck('name','id'),null ,['class' =>'form-control input-lg','multiple'=>true,'id' => 'prettify']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Exporter') !!}
        </div>

        <script type="text/javascript">
        $('#prettify').select2();
        </script>


        {!!Form::close()!!}

    </div>


@stop
