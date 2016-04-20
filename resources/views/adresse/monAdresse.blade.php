@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">

				<!-- ouverture du formulaire avec blade -->
				{{Form::open(['action' => 'monAdresseController@monAdresse', 'method'=>'GET', 'class'=> 'navbar-form', 'role'=>'search'] )}}

			        <div class="input-group">
			            <!-- rentrer l'adresse à géolocaliser / blade -->

			            {{Form::text('keyword', $keyword, ['placeholder'=>'Veuillez taper votre adresse','class' => 'form-control', 'size'=>80])}}

						 <div class="input-group-btn">

			                <button id="button" class="btn btn-default" type="submit">

			                	<i class="glyphicon glyphicon-search"></i>

			                </button>
			            </div>
			        </div>

				<!-- fermeture du formulaire avec blade -->
		        {{Form::close()}}
		</div>
	</div>

	@if ($searched)

	<!-- affichage de la map -->
	<div id="map"></div>

	<!-- script javascipt pour l'affichage de la map -->
	<script>

		window.onload=function initMap(){
			//ici, on crée la vue de base (coordonnées du get de l'adresse)
			var mymap = L.map('map').setView([{{$results['latitude']}}, {{$results['longitude']}}],16);

			//On set le "provider" et on set les attributions
		    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		    	//copyright + liens que l'on veut mettre en avant
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
			//rajouter ça à la variable
			}).addTo(mymap);

	    	//affichage des contacts géograpphiquement près de l'adresse en get
			@foreach($contacts as $contact)
				//création du marqueur
			   L.marker([{{$contact->latitude}},{{$contact->longitude}}]).addTo(mymap)
			   	//ce qu'il y a d'écrit dans le pop up
			    .bindPopup('{{$contact->name}}')
			    //ouverture du pop up
			    .openPopup();
			@endforeach
		};

	</script>


	<div class="container">
		<!-- tableau pour afficher les contacts géographiquement près de l'adresse get -->
		<table id="list_asbl" class="table">
			<thead>
				<tr>
					<!-- titre -->
					<th>Nom</th>
					<th>Adresse</th>
					<th>Localité</th>
					<th>Tags</th>
					<th>Coordonnées</th>
				</tr>
			</thead>


			@foreach($contacts as $contact)
				<tbody>
					<tr>
						<!-- données qu'on récupère dans la DB grace à ELOQUENT -->
						<td>{{$contact->name}}</td>
						<td>{{$contact->address}}</td>
						<td>{{$contact->locality}}</td>
						<td>
							@foreach ($contact->tags as $tag)
								<span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
							@endforeach
						</td>
						<td>{{$contact->latitude}}, {{$contact->longitude}}</td>
					</tr>
				</tbody>
			@endforeach
		</table>
	<!-- affichage des contacts en pagination -->
	{!! $contacts->render() !!}
	</div>
	@endif

@endsection
