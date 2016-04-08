@extends('admin.template')

@section('contenu')

    <br>

    <div class="col-sm-offset-0 col-sm-12">
        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif






        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des organismes</h3>
            </div>
            <table class="table">
                <thead>
                <tr>

                    <th>ID</th>
                    <th>Nom</th>
                    <th>Présentation</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Commune</th>
                    <th>Catégorie</th>
                    <th>Téléphone</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    <tr>

                        <td>{!! $contact->id !!}</td>
                        <td class="text-primary"><strong>{!! $contact->name !!}</strong></td>
                        <td class="text-primary"><strong>{!! $contact->description!!}</strong></td>
                        <td class="text-primary"><strong>{!! $contact->address !!}</strong></td>
                        <td class="text-primary"><strong>{!! $contact->postal_code !!}</strong></td>
                        <td class="text-primary"><strong>{!! $contact->locality !!}</strong></td>
                        <td class="text-primary"><strong>{!! $contact->categorie !!}</strong></td>
                        <td class="text-primary"><strong>{!! $contact->phone !!}</strong></td>

                        <td>{!! link_to_route('admin.contact.show', 'Voir', [$contact->id], ['class' => 'btn btn-success btn-block']) !!}</td>
                        <td>{!! link_to_route('admin.contact.edit', 'Modifier', [$contact->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
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
    </div>
@stop