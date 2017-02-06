@extends('layouts.app')
@section('content')
  <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


  <div class="container-fluid">



    <h1>Liste des contacts</h1>

    {!! $filter !!}
    {!! $grid !!}



    <div>
      <li>{{\App\Contact::where('geocode_status', '<' , 0)->count()}} contacts en erreur de géocalisation</li>
      <li>{{\App\Contact::where('geocode_status', 1)->count()}} contacts correctement géocalisés</li>
      <li>{{\App\Contact::where('geocode_status', 0)->count()}} contacts en attente</li>
    </div>

  </div>
@stop
