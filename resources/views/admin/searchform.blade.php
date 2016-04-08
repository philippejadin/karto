{{ Form::open(['action'=>'SearchController@search', 'method'=>'GET'] ) }}
{{ Form::text('keyword',null, array ('placeholder'=>'Rechercher...'))}}
{{ Form::submit('search')}}
{!! Form::close() !!}