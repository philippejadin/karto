@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Create New Contact</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'contacts.store']) !!}

            @include('contacts.fields')

        {!! Form::close() !!}
    </div>
</div>
@endsection