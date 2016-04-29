@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">

		<h1>Contacts liés au tag <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span></h1>

<table class="table">
		@forelse ($tag->contacts as $contact)
		
					<tr>
						<!-- données qu'on récupère dans la DB grace à ELOQUENT -->
						<td>{{$contact->name}}</td>
						<td>{{$contact->address}}</td>
						<td>{{$contact->locality}}</td>
					</tr>
			
		@empty
		Il n'y a pas encore de contact liè à ce tag
		@endforelse
</table>
		</div>

	</div>

@endsection
