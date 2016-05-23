@extends('layouts.app')

@section('content')

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <div class="container-fluid">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Modification de masse</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::open(['action' => 'TagController@change', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
                        {!! Form::label('tag', 'Modifier ce(s) tag :') !!}

                        <select class="form-control input-lg" id="tag" name="tags[]" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">

                        {!! Form::label('tag_to_add', 'Lui ajouter ce tag :') !!}
                        <select class="form-control input-lg" id="tag_to_add" name="tag_to_add">
                            <option value="0">Choisissez un tag</option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">

                        {!! Form::label('tag_to_remove', 'Lui enlever ce tag : ') !!}
                        <select class="form-control input-lg" id="tag_to_remove" name="tag_to_remove">
                            <option value="0">Choisissez un tag</option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-sm-12">
                        {!! Form::submit('Exécuter', ['class' => 'btn btn-primary pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.css' />
    <script type="text/javascript">
    $('#tag').select2();
    $('#tag_to_add').select2();
    $('#tag_to_remove').select2();
    </script>



@stop
