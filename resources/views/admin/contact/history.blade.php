@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="panel panel-default">
            <div class="panel-body">

            @foreach($contact->revisionHistory as $history )
                <div>
                    @if ($history->userResponsible())
                    {{ $history->userResponsible()->name }}
                    @endif

                        changed {{ $history->fieldName() }} from {{ $history->oldValue() }} to {{ $history->newValue() }}
                </div>
            @endforeach

        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
            </div>
    </div>
    </div>
@stop