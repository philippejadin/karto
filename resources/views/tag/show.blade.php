@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <h1>Contacts liés au tag <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span></h1>

            <table class="table">
                @forelse ($contacts as $contact)

                    <tr>
                        <td><a href="{{action('publicContactController@show', $contact)}}">{{$contact->name}}</a></td>
                        <td>{{$contact->address}}</td>
                        <td>{{$contact->locality}}</td>
                    </tr>

                @empty
                    Il n'y a pas encore de contact liè à ce tag
                @endforelse



            </table>
            {!!$contacts->render()!!}
        </div>

    </div>

@endsection
