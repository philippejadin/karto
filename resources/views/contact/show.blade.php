@extends('layouts.app')

@section('content')

  <div class="container">

    <div class="row">

      <h1>
        {{$contact->name}}
        @if(Auth::check() && Auth::user()->isAdmin())
          <a href="{{action('ContactController@edit', $contact)}}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i>Modifier ce contact</a>
        @endif
      </h1>

      <div>
        {!!$contact->description!!}
      </div>



      <div>
        <strong>
          {{$contact->address}}, {{$contact->postal_code}} {{$contact->locality}}
        </strong>
      </div>



      <div>
        {{$contact->phone}}
      </div>

      <div>
        {{$contact->email}}
      </div>

      <div>
        <a href="{{$contact->website}}" target="_blank">
          {{$contact->website}}
        </a>
      </div>


      <div>
        @each('tag.list', $contact->tags, 'tag')
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

      var others_marker = L.VectorMarkers.icon({
        icon: 'circle-o',
        markerColor: '#0a0'
      });

      @if ($contacts)
      @foreach ($contacts as $other_contact)
      L.marker([{{$other_contact->latitude}},{{$other_contact->longitude}}], {icon: others_marker}).addTo(map).bindPopup("<a href=\"{{action('publicContactController@show', $other_contact)}}\">{{$other_contact->name}}</a><br/>{{ $other_contact->summary(300) }}");
      @endforeach
      @endif


      var main_marker = L.VectorMarkers.icon({
        icon: 'circle-o',
        markerColor: '#a00'
      });

      L.marker([{{$contact->latitude}},{{$contact->longitude}}], {icon: main_marker}).addTo(map).bindPopup("<a href=\"{{action('publicContactController@show', $contact)}}\">{{$contact->name}}</a><br/>{{ $contact->summary(300) }}");



      </script>



      @if ($contacts)

        <strong>Contacts à proximité (à moins d'un kilomètre)</strong>
        <div class="see_also">
          @foreach ($contacts as $contact)
            <a href="{{action('publicContactController@show', $contact)}}">{{$contact->name}}</a><br/>
          @endforeach
        </div>
      @endif






    </div>



  </div>

@endsection
