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


        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">



                @if(Auth::check() && Auth::user()->isAdmin())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Contacts <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{action('ContactController@index')}}">Liste</a></li>
                            <li><a href="{{action('ContactController@create')}}">Ajouter</a></li>
                            <li><a href="{{action('ImportController@importForm')}}">Importer</a></li>
                            <li><a href="{{action('ExportController@form')}}">Exporter</a></li>

                            <li class="divider"></li>
                            <li><a href="{{action('ReportController@geocoded')}}">Liste des contacts en erreur de géocodage</a></li>
                            <li><a href="{{action('ReportController@duplicates')}}">Liste des doublons</a></li>
                            <li><a href="{{action('ReportController@untagged')}}">Liste des contacts sans tags</a></li>
                            <li><a href="{{action('ReportController@withOnlyMasterTag')}}">Liste des contacts avec uniquement un tag principal</a></li>

                            <li class="divider"></li>
                            <li><a href="{{action('MassDeleteController@massDeleteForm')}}">Effacement en masse de contacts par tag</a></li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Tags <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{action('TagController@index')}}">Liste</a></li>
                            <li><a href="{{action('TagController@create')}}">Ajouter</a></li>
                            <li class="divider"></li>
                            <li><a href="{{action('TagController@change')}}">Changement en masse</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Utilisateurs <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{action('UserController@index')}}">Liste</a></li>
                        </ul>
                    </li>
                @endif




            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Connexion</a></li>
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

                      @if (isset($keywords))
                        {{ Form::text('keywords',$keywords, ['class' => 'form-control'] ) }}
                      @else
                        {{ Form::text('keywords',null, ['placeholder'=>'Rechercher...', 'class' => 'form-control'] ) }}
                      @endif

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
