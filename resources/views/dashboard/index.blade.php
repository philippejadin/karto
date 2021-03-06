@extends('layouts.app')

@section('content')


  <div class="container">

    <div class="row" style="padding: 2em;">

      @unless ($searched)
        <div class="alert alert-info">
          <p>
            Bienvenue dans le système de cartographie de <a href="http://yapaka.be">Yapaka</a>.
          </p>
          <p>
            En entrant votre code postal, ou votre adresse ce système de cartographie vous aide à trouver
            un professionnel ou un organisme proche de chez vous.
          </p>
          <p>
            Notamment, les crèches, les écoles, les différents services de l'Aide à la Jeunesse, les Maisons Vertes,
            les consultations ONE, les AMO, les Maisons de Jeune, les centres Adeps,...​
          </p>
        </div>
      @endunless





      {{Form::open(['action' => 'DashboardController@index', 'method'=>'GET', 'class'=> 'form-inline', 'role'=>'search'] )}}
      <div class="form-group">
        {{Form::text('keyword', $keyword, ['placeholder'=>'Veuillez taper une adresse ou un code postal','class' => 'form-control', 'size' => '50'])}}
        {!! Form::select('km',array('1'=>'1 km', '2'=>'2 km','5'=>'5 km','10'=>'10 km', '15'=>'15 km','20'=> '20 km','50'=> '50 km', '100'=>'100 km'), $km, ['class' => 'form-control'])!!}
        {!! Form::select('tag', $master_tags, $tag, ['class' => 'form-control', 'placeholder' => 'Limiter la recherche à : '])!!}
        <button id="button" class="btn btn-primary" type="submit">
          <i class="glyphicon glyphicon-search"></i> Chercher
        </button>
      </div>
      {{Form::close()}}

    </div>
  </div>




  @if ($searched)

    <div id="map"></div>


    @push('scripts')
      <script>
      //ici, on crée la vue de base (coordonnées du get de l'adresse)
      var map = L.map('map').setView([{{$results['latitude']}}, {{$results['longitude']}}],14);

      // On set le "provider" et on set les attributions
      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);


      // Creates a red marker with the coffee icon
      var youarehereMarker = L.VectorMarkers.icon({
        icon: 'circle-o',
        markerColor: '#aaa'
      });

      L.marker([{{$results['latitude']}},{{$results['longitude']}}], {icon: youarehereMarker}).addTo(map).bindPopup("Vous êtes ici");

      layerControl = L.control.layers().addTo(map);

      // affichage des contacts qui ont un master tag
      @foreach ($tags as $tag)

      var marker = L.VectorMarkers.icon({
        icon: 'circle',
        markerColor: '{{$tag['tag']->color}}'
      });


      tagLayerGroup{{$tag['tag']->id}} = L.layerGroup()
      @foreach($tag['contacts'] as $contact)
      .addLayer(L.marker([ {{$contact->latitude}}, {{$contact->longitude}} ], {icon: marker})
      .bindPopup(`<a href=\"{{action('publicContactController@show', $contact)}}\">{{$contact->name}}</a><br/>{{$contact->summary(300)}}`))
      @endforeach
      .addTo(map);
      layerControl.addOverlay(tagLayerGroup{{$tag['tag']->id}}, "{{$tag['tag']->name}}");
      @endforeach;



      // affichage des autres contacts
      @if (count($other_contacts) > 0)
      var othersLayerGroup = L.layerGroup()
      @foreach($other_contacts as $contact)
      .addLayer(L.marker([{{$contact->latitude}},{{$contact->longitude}}], {icon: youarehereMarker})
      .bindPopup(`<a href=\"{{action('publicContactController@show', $contact)}}\">{{$contact->name}}</a><br/>{{$contact->summary(300)}}`))
      @endforeach
      .addTo(map);
      layerControl.addOverlay(othersLayerGroup, "Autres organismes");

      @endif

      </script>

    @endpush







    @foreach($tags as $tag)
      @if (count($tag['contacts']) > 0)
        <div class="contacts">
          <div class="tag  @if ($tag['tag']->getColor()->isLight()) darktext @endif" style="background-color: #{{$tag['tag']->getColor()->lighten()}}">
          <h2> {{$tag['tag']->name}}</h2>
          <p> {{$tag['tag']->description}}</p>
          </div>

          <div class="container">

          @foreach(array_chunk($tag['contacts'], 3) as $chunk)
            <div class="row">
              @foreach ($chunk as $contact)
                <div class="col-sm-4 contact">
                  <h3><a href="{{action('publicContactController@show', $contact)}}">{{$contact->name}}</a></h3>
                  <p class="description"> {{summary($contact->description)}}</p>
                  <p class="address">{{$contact->address}}, {{$contact->locality}}</p>

                  <div class="tags">
                    @each('tag.list', $contact->publicTags, 'tag')
                  </div>
                </div>
              @endforeach
            </div>
          @endforeach
        </div>
      </div>

    @endif
  @endforeach



  @if (count($other_contacts) > 0)
    <div class="contacts">
      <div class="tag" style="background-color: #a0a">
        <h2>Autres organismes</h2>
        <p>Les organismes ci-dessous ne sont pas repris dans une des catégories principales, mais peuvent néanmoins vous intéresser</p>
      </div>

      <div class="container">

        @foreach(array_chunk($other_contacts, 3) as $chunk)
          <div class="row">
            @foreach ($chunk as $contact)
              <div class="col-sm-4 contact">
                <h3><a href="{{action('publicContactController@show', $contact)}}">{{$contact->name}}</a></h3>
                <p class="description"> {{summary($contact->description)}}</p>
                <p class="address">{{$contact->address}}, {{$contact->locality}}</p>

                <div class="tags">
                  @foreach ($contact->publicTags as $tag)
                    <a href="{{action('publicTagController@show', $tag)}}"><span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span></a>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>

  @endif

@endif


@endsection
