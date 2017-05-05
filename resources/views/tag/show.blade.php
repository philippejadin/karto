@extends('layouts.app')

@section('content')

  <div class="container">

    <div class="row">

      <h1>
        Contacts appartenant à la catégorie <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
        @if(Auth::check() && Auth::user()->isAdmin())
          <a href="{{ route('admin.tag.edit', [$tag->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Modifier</a>
        @endif
      </h1>

      <p>
        {{$tag->description}}
      </p>

      <table class="table">
        @forelse ($contacts as $contact)

          <tr>
            <td>
              <a href="{{action('publicContactController@show', $contact)}}">{{$contact->name}}</a>
            </td>
            <td>{{$contact->address}}</td>
            <td>{{$contact->postal_code}}</td>
            <td>{{$contact->locality}}</td>
            @if(Auth::check() && Auth::user()->isAdmin())
              <td>
                <a href="{{ action('ContactController@edit', $contact) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Modifier</a>
                <a href="{{action('ContactController@destroy', $contact)}}" class="btn btn-warning"  onclick="return confirm('Vraiment supprimer ce contact?')"><i class="fa fa-trash"></i>Effacer ce contact</a>
              </td>

            @endif
          </tr>

        @empty
          Il n'y a pas encore de contact liè à ce tag
        @endforelse



      </table>
      {!!$contacts->render()!!}
    </div>

  </div>

@endsection
