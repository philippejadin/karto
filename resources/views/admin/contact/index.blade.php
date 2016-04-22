@extends('layouts.app')
@section('content')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


    <div class="container">

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              {{ Session::get('success') }}
            </div>
        @endif


            {{Form::open(['action' => 'BatchController@action'])}}

            <select type="select" name="action">
                <option name="select" value="select" selected="selected">Choisissez l'action à effectuer ci dessous...</option>
                <option name="delete" value="delete">Effacer</option>
            </select>

            <button type="submit">Effectuer</button>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des organismes</h3>
            </div>
            <table class="table special">
                <thead>
                <tr>
                    <th style="width:15px"></th>
                    <th style="width:20px">ID</th>
                    <th style="width:20%">Nom</th>
                    <th style="width:10%" class="hidden-xs">Description</th>
                    <th style="width:10%" class="hidden-xs">Adresse</th>
                    <th style="width:5%">Code postal</th>
                    <th style="width:10%" class="hidden-xs">Commune</th>
                    <th style="width:10%" class="hidden-xs">Téléphone</th>
                    <th style="width:10%">Tag </th >
                    <th style="width:20%">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($contacts as $contact)
                    <tr>
                            <td>{{ form::checkbox('check[' . $contact->id . ']',1,0) }} </td>
                            <td>{!! $contact->id !!}</td>
                            <td class="text-primary ellipse"><a href="{{ route('admin.contact.show',  [$contact->id]) }}" ><strong>{!! $contact->name !!}</strong></a></td>
                            <td class="text-primary ellipse hidden-xs"><strong>{!! $contact->description!!}</strong></td>
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
                                <a href="{{ route('admin.contact.show',  [$contact->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.contact.edit', [$contact->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.contact.destroy', $contact->id]]) !!}
                                     <button type="submit" class="btn btn-danger" onclick="return confirm('Vraiment supprimer cet organisme?')"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                            </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! link_to_route('admin.contact.create', 'Ajouter un organisme', [], ['class' => 'btn btn-info pull-right']) !!}
        {!! $contacts->render() !!}
    </div>


    {!! Form::close() !!}

@stop
