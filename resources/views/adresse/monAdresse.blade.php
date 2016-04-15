@extends('layouts.app')

@section('content')
	</br>

	{{Form::open(['action' => 'monAdresseController@monAdresse', 'method'=>'GET'])}}

		<div class="input-group">
		<!-- Formulaire pour rentrer son adresse --> 
		{{Form::text('keyword', null, ['placeholder'=>'Veuillez taper votre adresse', 'class' => 'form-control'])}}
		
<!-- 		 <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
        		<i class="glyphicon glyphicon-search"></i>
        	</button>
        </div> -->
        {{Form::submit('search')}}
    </div>

	{{Form::close()}}

	<!-- div pour afficher ses données de géolocalisation -->
{{--	<table,id="list_asbl">
		@foreach($contacts as $contact)
			<thead>
				<tr>
					<th>{{$contacts->categorie}}</th>
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
		@endforeach
--}} 
{{-- 	<div id="listContact">
<table>
	@foreach ($contacts as $contact)
		<tr>
			<td>
			{{$contact->categorie}} </br>
			</td>

			<td>
			{{$contact->name}} </br>
			</td>

			<td>
			{{$contact->latitude}} </br>
			</td>

			<td>
			{{$contact->longitude}} </br>
			</td>
		</tr>
	@endforeach
</table> 

{!! $contacts->render() !!}
</div>   --}}
@endsection