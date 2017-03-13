@extends('layouts.app')

@section('content')

  <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

  <div class="container-fluid">
    <br>
    <div class="panel panel-primary">
      <div class="panel-heading">Effacement de masse</div>
      <div class="panel-body">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::open(['action' => 'MassDeleteController@massDelete', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
            {!! Form::label('tag', 'Effacer tous les contacts liés à ce tag (attention à ce que vous faite !):') !!}

            <select class="form-control input-lg" id="tag" name="tags[]">
              @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
              @endforeach
            </select>

          </div>



          <div class="form-group col-sm-12">
            {!! Form::submit('Exécuter', ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
      <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
    </a>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.js'></script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.css' />
  <script type="text/javascript">
  $('#tag').select2();

  </script>



@stop
