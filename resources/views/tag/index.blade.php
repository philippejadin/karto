@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">


			<h1>Liste complète des catégories de contacts sur ce serveur</h1>

			@foreach ($tags as $tag)

				<a href="{{action('publicTagController@show', $tag)}}" title="{{$tag->description}}">
					<span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
				</a>
			@endforeach

		</div>

	</div>


@stop
