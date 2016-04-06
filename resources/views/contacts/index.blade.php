@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Contacts</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('contacts.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($contacts->isEmpty())
            <div class="well text-center">No Contacts found.</div>
        @else
            @include('contacts.table')
        @endif
        
    </div>
@endsection