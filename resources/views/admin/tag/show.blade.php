@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Fiche d'un tag</div>
            <div class="panel-body">
                <p>Nom : {{ $tag->name }}</p>
                <p>Présentation : {{ $tag->description}}</p>
                <p>Adresse : {{ $tag->color}}</p>


            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>
@stop