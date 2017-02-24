
<a href="{{action('publicTagController@show', $tag)}}" title="{{$tag->description}}">
  <span class="label label-default" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
</a>
