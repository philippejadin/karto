@extends('layouts.app')
@section('content')



    <div class="container">



        <h1>Liste des doublons</h1>

        <p>Les contacts ci-dessous ont un nom similaire et une latitude et longitude identiques</p>

        @foreach ($duplicates as $duplicate)
            @foreach ($duplicate as $id=>$name)
                <li><a href="{{action('ContactController@show', $id)}}">{{$id}} -> {{$name}}</a></li>
                @endforeach
                <hr/>
            @endforeach



        </div>

    @stop
