@extends('layouts.app')
@section('content')




    <div class="container-fluid">

        {!! link_to_route('admin.tag.create', 'Ajouter un tag', [], ['class' => 'btn btn-info pull-right']) !!}

        <h1>Liste des tags</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Couleur</th>
                    <th>Tag principal ?</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>

                        <td>{!! $tag->id !!}</td>
                        <td><strong>{{ $tag->name }}</strong></td>
                        <td><strong>{{ $tag->description }}</strong></td>
                        <td><div style="background-color:{{ $tag->color }}; width:30px; height: 30px">&nbsp;</div></td>

                        <td>
                            @if ($tag->master_tag == 1)
                                Oui
                            @endif
                        </td>


                        <td><a href="{{ action('publicTagController@show',  [$tag->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                        <td><a href="{{ route('admin.tag.edit', [$tag->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a></td>


                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.tag.destroy', $tag->id]]) !!}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Vraiment supprimer ce tag? (les contacts liés à ce tag ne seront pas effacés)')"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! link_to_route('admin.tag.create', 'Ajouter un tag', [], ['class' => 'btn btn-info pull-right']) !!}
    </div>



</div>


@stop
