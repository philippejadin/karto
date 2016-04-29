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


            {!!Form::open(['action' => 'BatchController@action', 'method' => 'post'])!!}

            <select type="select" name="action">
                <option name="select" value="select" selected="selected">Choisissez l'action à effectuer ci dessous...</option>
                <option name="delete" value="delete">Effacer</option>
            </select>

            <button type="submit">Effectuer</button>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des organismes</h3>

                {!! link_to_route('admin.contact.create', 'Ajouter un organisme', [], ['class' => 'btn btn-info pull-right']) !!}
                {!! $contacts->render() !!}
            </div>






            <table class="table special">
                <thead>
                <tr>
                    <th style="width:20px"></th>
                    <th style="width:40px">ID
                        <a href="{{ action('ContactController@index') }}?sort=id&order=asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="{{ action('ContactController@index') }}?sort=id&order=desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                    <th style="width:20%">Nom
                        <a href="{{ action('ContactController@index') }}?sort=name&order=asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="{{ action('ContactController@index') }}?sort=name&order=desc"><i class="fa fa-sort-desc"></i></a>
                    </th>

                    <th style="width:10%" class="hidden-xs">Adresse
                        <a href="{{ action('ContactController@index') }}?sort=address&order=asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="{{ action('ContactController@index') }}?sort=address&order=desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                    <th style="width:7%">CP
                        <a href="{{ action('ContactController@index') }}?sort=postal_code&order=asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="{{ action('ContactController@index') }}?sort=postal_code&order=desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                    <th style="width:10%" class="hidden-xs">Commune
                        <a href="{{ action('ContactController@index') }}?sort=locality&order=asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="{{ action('ContactController@index') }}?sort=locality&order=desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                    <th style="width:10%" class="hidden-xs">Téléphone</th>
                    <th style="width:10%">Tags</th >
                        <th style="width:5%">Status</th >
                    <th style="width:20%">Actions
                        <a href="{{ action('ContactController@index') }}?sort=geocode_status&order=asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="{{ action('ContactController@index') }}?sort=geocode_status&order=desc"><i class="fa fa-sort-desc"></i></a>
                    </th>

                </tr>
                </thead>
                <tbody>

                @foreach ($contacts as $contact)
                    <tr>
                            <td>{{ form::checkbox('check[' . $contact->id . ']',1,0) }} </td>
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
                                <a href="{{ action('ContactController@destroy', [$contact->id]) }}" class="btn btn-danger"  onclick="return confirm('Vraiment supprimer cet organisme?')"><i class="fa fa-trash"></i></a>

                                <a href="{{ action('ContactController@history', [$contact->id]) }}" class="btn btn-info"><i class="fa fa-history"></i></a>



                            </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-footer">
            {!! link_to_route('admin.contact.create', 'Ajouter un organisme', [], ['class' => 'btn btn-info pull-right']) !!}
            {!! $contacts->render() !!}
            </div>

        </div>

    </div>


    {!! Form::close() !!}

@stop
