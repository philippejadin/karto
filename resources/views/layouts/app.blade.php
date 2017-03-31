<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@if (isset($title)) {{$title}} @else Cartographie @endif</title>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    {!! Html::style('js/leaflet-vector-markers/Leaflet.vector-markers.css') !!}

    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">



    <!-- Custom, final styling -->
    {!! Html::style('css/style.css') !!}


    <!-- JavaScripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


    <!-- leaflet - Vector markers -->
    {!! Html::script('js/leaflet-vector-markers/Leaflet.vector-markers.min.js') !!}






  </head>
  <body id="app-layout" @if (isset($home)) class="home" @endif>


    @include('layouts.nav')

    @include('flash::messages')


    @yield('content')



    <div class="container footer">
      <!-- Catégories d'organismes présentes sur ce serveur :-->

    </div>


    @stack('scripts')


  </body>
  </html>
