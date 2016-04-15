@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Fiche d'un tag</div>
            <div class="panel-body">
                <p>Nom : {{ $tag->name }}</p>
                <p>Description : {{ $tag->description}}</p>
                <p class="text-primary">
                    <div style="background-color:{{ $tag->color }}; width:30px; height: 30px">&nbsp;
                    </div>
                </p>



            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>
@stop