
@extends('layouts.app')

@section('content')

  <div class="container">



    <h1>Importation d'organismes</h1>


    {!! Form::open(['action' => 'ImportController@importForm', 'method' => 'post', 'class' => 'form-horizontal panel', 'files'=> true]) !!}

    <div class="alert alert-info" role="alert">
      Choisissez un fichier excell contenant les colonnes suivantes au minimum :
      <ul>
        <li>address</li>
        <li>name</li>
        <li>postal_code</li>
      </ul>
    </div>

    <div class="form-group">
      <label for="import_file">Fichier à importer</label>
      {!! Form::file('import_file') !!}
    </div>



    <div class="form-group">
      {!! Form::submit('Importer') !!}
    </div>

    {!! Form::close() !!}

  @endsection
