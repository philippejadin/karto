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

	<!-- affichage de la map -->
	<div id="mapid"></div>
	<script>
	 	function initMap(latitude, longitude, adresse){
	 		var mymap = L.map('map').setView([latitude, longitude],13);

	 		L.titleLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    				attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    				maxZoom :18,
    				id: 'your.mapbox.projetct.id',
    				acessToken: 'your.mapbox.public.access.token'
    			}).addTo(mymap);

	 		L.marker([latitude,longitude]).addTo(mymap)
	 				.bindPopup(adresse.name).openPopup();

	 		var popup = L.popup();

	 		function onMapClick(e){
	 			popup	
	 					.setLatLng(e.latlng)
	 					.serContent("You clicked the map at" + e.latlng)
	 					.openOn(mymap);
	 		}

	 		mymap.on('click', onMapClick);
	 	}
	</script>

	 <!-- afficher ong/lat en html => transformer en javascript => points sur la carte! --> 

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