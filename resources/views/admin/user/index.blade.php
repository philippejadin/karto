@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <h1>Liste des utilisateur</h1>

        <table class="table special">
            <thead>
                <td>
                    Email
                </td>
                <td>
                    Outils
                </td>

            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{!! $user->email !!}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>




@stop
