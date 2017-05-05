@extends('layouts.app')
@section('content')


  <div class="container">


    <h1>
      {{$title or 'Recherche des contacts'}}
    </h1>




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
          <th></th>
        </tr>


      </thead>
      <tbody>

        @foreach ($contacts as $contact)
          <tr>
            <td>{!! $contact->id !!}</td>
            <td class="text-primary ellipse"><a href="{{ action('publicContactController@show',  $contact) }}" ><strong>{!! $contact->name !!}</strong></a>
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
            @if(Auth::check() && Auth::user()->isAdmin())
              <a href="{{ route('admin.contact.show',  [$contact->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
              <a href="{{ route('admin.contact.edit', [$contact->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
              <a href="{{ route('contact.delete', [$contact->id]) }}" class="btn btn-danger"  onclick="return confirm('Vraiment supprimer ce contact?')"><i class="fa fa-trash"></i></a>
              <a href="{{ action('ContactController@history', [$contact->id]) }}" class="btn btn-info"><i class="fa fa-history"></i></a>
            @endif
          </td>


          </tr>
        @endforeach
      </tbody>
    </table>




  </div>

</div>





@stop
