
<a href="{{action('publicTagController@show', $tag)}}" title="{{$tag->description}}">
  <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
</a>
@if (!empty($tag->description))
   : {{$tag->description}}
@endif
<br/>
