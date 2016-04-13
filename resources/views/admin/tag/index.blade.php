@extends('layouts.app')
@section('content')




    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des tags</h3>
            </div>
            <table class="table">
                <thead>
                <tr>

                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Couleur</th>



                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr>

                        <td>{!! $tag->id !!}</td>
                        <td class="text-primary"><strong>{{ $tag->name }}</strong></td>
                        <td class="text-primary"><strong>{{ $tag->description }}</strong></td>
                        <td class="text-primary"><div style="background-color:{{ $tag->color }}; width:30px; height: 30px">&nbsp;</div></td>


                        <td><a href="{{ route('admin.tag.show',  [$tag->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <td><a href="{{ route('admin.tag.edit', [$tag->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                        <td><a href="{{ route('admin.tag.destroy', [$tag->id]) }}" class="btn btn-danger"><i class="fa fa-trash" ></i></a>


                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.tag.destroy', $tag->id]]) !!}
                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce tag?\')']) !!}
                            {!! Form::close() !!}

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! link_to_route('admin.tag.create', 'Ajouter un tag', [], ['class' => 'btn btn-info pull-right']) !!}

        {!! $tags->render() !!}
    </div>


@stop
