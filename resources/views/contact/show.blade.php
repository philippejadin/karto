@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">

		<h1>{{$contact->name}}</h1>
				
					<td>{{$contact->address}}</td>
					<td>{{$contact->locality}}</td>
					<td>
						@foreach ($contact->tags as $tag)
							<span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
						@endforeach
					</td>
		
		</div>

<a href="{{action('ContactController@edit', $contact)}}">Modifier cet organisme</a>

	</div>

@endsection


