@extends('layouts.app')

@section('content')
	</br>

	{{Form::open(['action' => 'monAdresseController@monAdresse', 'method'=>'GET'])}}

		<div class="input-group">
		<!-- Formulaire pour rentrer son adresse --> 
		{{Form::text('keyword', null, ['placeholder'=>'Veuillez taper votre adresse', 'class' => 'form-control'])}}
		
        {{Form::submit('search')}}
    </div>

	{{Form::close()}}

	<!-- div pour afficher ses données de géolocalisation -->
<table id="list_asbl">
		
			<thead>
				<tr>
					<th>Nom</th>
					<th>Adresse</th>
					<th>Localité</th>
				</tr>
			</thead>


			<tbody>
			@foreach($contacts as $contact)
				<tr>
					<td>{{$contact->name}}</td>
					<td>{{$contact->address}}</td>
					<td>{{$contact->locality}}</td>


				</tr>
			@endforeach	
			</tbody>
		</table>
		


{!! $contacts->render() !!}
</div> 

<pre>
{{ var_dump($results) }}
</pre>


@endsection