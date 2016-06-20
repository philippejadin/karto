@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <h1>{{$contact->name}}</h1>

            <div>
                <strong>{{$contact->address}}, {{$contact->postal_code}} {{$contact->locality}}</strong>
            </div>

            <div>
                {{$contact->description}}
            </div>

            <div>
                {{$contact->phone}}
            </div>

            <div>
                {{$contact->email}}
            </div>

            <div>
                {{$contact->website}}
            </div>


            <div>
                @foreach ($contact->tags as $tag)
                    <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
                @endforeach
            </div>


            <!-- affichage de la map -->
            <div id="map"></div>

            <!-- script javascipt pour l'affichage de la map -->
            <script>
            //ici, on crée la vue de base (coordonnées du get de l'adresse)
            var map = L.map('map').setView([{{$contact->latitude}}, {{$contact->longitude}}],17);

            // On set le "provider" et on set les attributions
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);



            var youarehereMarker = L.VectorMarkers.icon({
                icon: 'circle-o',
                markerColor: '#a00'
            });

            L.marker([{{$contact->latitude}},{{$contact->longitude}}], {icon: youarehereMarker}).addTo(map).bindPopup("<a href=\"{{action('publicContactController@show', $contact)}}\">{{$contact->name}}</a><br/>{{ $contact->summary(300) }}");

            </script>









        </div>

        @if(Auth::check() && Auth::user()->isAdmin())
            <a href="{{action('ContactController@edit', $contact)}}">Modifier ce contact</a>
        @endif

    </div>

@endsection
