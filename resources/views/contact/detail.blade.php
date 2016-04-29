@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">

		<h1>{{$contact->name}}</h1>
		
	<table class="table">
			@foreach($contacts as $contact)
				<tr>
					<td>{{$contact->name}}</td>
					<td>{{$contact->address}}</td>
					<td>{{$contact->locality}}</td>
					<td>
						@foreach ($contact->tags as $tag)
							<span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
						@endforeach
					</td>
				</tr>
			@endforeach
		</table>

		</div>
	</div>

@endsection


