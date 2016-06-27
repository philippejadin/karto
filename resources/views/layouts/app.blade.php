<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Karto</title>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    {!! Html::style('js/leaflet-vector-markers/Leaflet.vector-markers.css') !!}


    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <!-- leaflet - Vector markers -->
    {!! Html::script('js/leaflet-vector-markers/Leaflet.vector-markers.min.js') !!}


    <!-- Custom, final styling -->
    {!! Html::style('css/style.css') !!}




</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Cartographie de Yapaka
                </a>

            </div>

            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Contacts <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{action('ContactController@index')}}">Liste</a></li>
                                <li><a href="{{action('ContactController@create')}}">Ajouter</a></li>
                                <li><a href="{{action('ExportController@form')}}">Exporter</a></li>
                                <li><a href="{{action('ContactController@indexGeocoded')}}">Liste des contacts en erreur de géocodage</a></li>
                            </ul>
                        </li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Tags <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{action('TagController@index')}}">Liste</a></li>
                                <li><a href="{{action('TagController@create')}}">Ajouter</a></li>
                                <li><a href="{{action('TagController@change')}}">Changement en masse</a></li>
                            </ul>
                        </li>




                    </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>


                @if(Auth::check() && Auth::user()->isAdmin())
                    <div class="col-sm-3 col-md-3 pull-right">


                        {{ Form::open(['action'=>'SearchController@search', 'method'=>'GET', 'class'=>'navbar-form',  'role'=>'search'] ) }}
                        <div class="input-group">

                            {{ Form::text('keyword',null, ['placeholder'=>'Rechercher...', 'class' => 'form-control'] ) }}
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                        {!! Form::close() !!}



                    </div>
                @endif

            </div>
        </div>
    </nav>



    @include('flash::messages')


    @yield('content')

    <script>
    // Rendre modal le panneau overlay éventuel
    $('#flash-overlay-modal').modal();
    </script>

</body>
</html>
