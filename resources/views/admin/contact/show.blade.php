@extends('admin.template')

@section('contenu')
    <div class="col-sm-offset-0 col-sm-12">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Fiche d'utilisateur</div>
            <div class="panel-body">
                <p>Nom : {{ $contact->name }}</p>
                <p>Présentation : {{ $contact->description}}</p>
                <p>Adresse : {{ $contact->address}}</p>
                <p>Code postal : {{ $contact->postal_code}}</p>
                <p>Commune: {{ $contact->locality }}</p>
                <p>Pays : {{ $contact->country}}</p>
                <p>Catégorie : {{ $contact->categorie}}</p>
                <p>Téléphone : {{ $contact->phone }}</p>
                <p>Téléphone 2 : {{ $contact->phone2}}</p>
                <p>Site web : {{ $contact->website }}</p>
                <p>Email : {{ $contact->email }}</p>
                <p>Identifiant_externe : {{ $contact->Identifiant_externe }}</p>

            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>
@stop