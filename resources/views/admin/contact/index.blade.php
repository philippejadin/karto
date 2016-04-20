@extends('layouts.app')
@section('content')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


    <div class="container" xmlns="http://www.w3.org/1999/html">

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              {{ Session::get('success') }}
            </div>
        @endif




        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des organismes</h3>
            </div>
            <table class="table">
                <thead>
                <tr>

                    <th></th>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Présentation</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Commune</th>
                    <th>Catégorie</th>
                    <th>Téléphone</th>
                    <th>longitude</th>
                    <th>latitude</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        {{Form::open()}}
                            <td>    {{ form::checkbox('check[' . $contact->id . ']',$contact->id,0) }}   </td>
                            <td>{!! $contact->id !!}</td>
                            <td class="text-primary"><strong>{!! $contact->name !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->description!!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->address !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->postal_code !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->locality !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->categorie !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->phone !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->longitude !!}</strong></td>
                            <td class="text-primary"><strong>{!! $contact->latitude !!}</strong></td>

                            <td><a href="{{ route('admin.contact.show',  [$contact->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                            <td><a href="{{ route('admin.contact.edit', [$contact->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                            <td><a href="{{ route('admin.contact.destroy', [$contact->id]) }}" class="btn btn-danger"><i class="fa fa-trash" ></i></a>
                        {{Form::close()}}

                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.contact.destroy', $contact->id]]) !!}
                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet oraganisme?\')']) !!}
                            {!! Form::close() !!}
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! link_to_route('admin.contact.create', 'Ajouter un organisme', [], ['class' => 'btn btn-info pull-right']) !!}
        {!! $contacts->render() !!}



            {{--

            {!! Form::model($contact, ['route' => ['admin.contact.update', $contact->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
                <div class="form-group">
                    {!! Form::label('tags[]', 'Tag') !!}
                    {!! Form::select('tags[]', App\Tag::pluck('name','id'),$contact->tags->pluck('id'),['class' =>'form-control input-lg','multiple'=>true,'id' => 'prettify']) !!}
                </div>
                <script type="text/javascript">
                    $('#prettify').select2();
                    $('#e18,#e18_2').select2();
                </script>
            {!! Form::submit('Ajouter le(s) Tag', ['class' => 'btn btn-info']) !!}
            {!! Form::close() !!}

            --}}

    </div>

@stop
