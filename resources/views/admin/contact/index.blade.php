@extends('layouts.app')
@section('content')
  <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


  <div class="container-fluid">



    <h1>
      @if ($title)
        {{$title}}
      @else
        Liste des contacts
      @endif
    </h1>


    {!! link_to_route('admin.contact.create', 'Ajouter un contact', [], ['class' => 'btn btn-info pull-right']) !!}
    {!! $contacts->render() !!}


    <table class="table special">
      <thead>
        <tr>
          <th style="width:40px">ID</th>
          <th style="width:20%">Nom</th>
          <th style="width:10%" >Adresse</th>
          <th>CP</th>
          <th>Commune</th>
          <th>Téléphone</th>
          <th>Tags</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>


      </thead>
      <tbody>

        @foreach ($contacts as $contact)
          <tr>
            <td>{!! $contact->id !!}</td>
            <td class="text-primary ellipse"><a href="{{ route('admin.contact.edit',  [$contact->id]) }}" ><strong>{!! $contact->name !!}</strong></a>
              <br/>
              {{ strip_tags($contact->description) }}
            </td>

            <td class="text-primary ellipse hidden-xs"><strong>{!! $contact->address !!}</strong></td>
            <td class="text-primary ellipse"><strong>{!! $contact->postal_code !!}</strong></td>
            <td class="text-primary hidden-xs ellipse"><strong>{!! $contact->locality !!}</strong></td>
            <td class="text-primary ellipse hidden-xs" ><strong>{!! $contact->phone !!}</strong></td>
            <td>
              @foreach($contact->tags as $tag)
                <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
              @endforeach
            </td>

            <td>
              @if ($contact->geocode_status == 1)
                <i class="fa fa-check" aria-hidden="true" title="Contact correctement géocodé"></i>

              @endif

              @if ($contact->geocode_status == 0)
                <i class="fa fa-clock-o" aria-hidden="true" title="Contact pas encore géocodé"></i>

              @endif

              @if ($contact->geocode_status < 0)
                <i class="fa fa-exclamation-triangle" aria-hidden="true" title="Erreur de géocolocalisation, vérifiez l'adresse encodée"></i>
              @endif

            </td>
            <td>
              <a href="{{ route('admin.contact.show',  [$contact->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
              <a href="{{ route('admin.contact.edit', [$contact->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
              <a href="{{ route('contact.delete', [$contact->id]) }}" class="btn btn-danger"  onclick="return confirm('Vraiment supprimer ce contact?')"><i class="fa fa-trash"></i></a>
              <a href="{{ action('ContactController@history', [$contact->id]) }}" class="btn btn-info"><i class="fa fa-history"></i></a>



            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {!! link_to_route('admin.contact.create', 'Ajouter un organisme', [], ['class' => 'btn btn-info pull-right']) !!}
    {!! $contacts->render() !!}


  </div>

</div>





<div>
  <li>{{\App\Contact::where('geocode_status', '<' , 0)->count()}} contacts en erreur de géocalisation</li>
  <li>{{\App\Contact::where('geocode_status', 1)->count()}} contacts correctement géocalisés</li>
  <li>{{\App\Contact::where('geocode_status', 0)->count()}} contacts en attente</li>
</div>

@stop
