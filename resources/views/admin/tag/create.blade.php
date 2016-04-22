@extends('layouts.app')

@section('content')
    <div class="container-fluid">
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
            preferredFormat: "hex",
            showPaletteOnly: true,
            togglePaletteOnly: true,
            togglePaletteMoreText: 'more',
            togglePaletteLessText: 'less',
            color: 'blanchedalmond',
            palette: [
                ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
                ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
                ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
                ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
                ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
                ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
                ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
                ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
            ]
        });

    </script>

@stop
