@extends('layouts.app')

@section('content')
    <table class="table table-bordered" id="contacts-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
    <script>
    $(function() {
        $('#contacts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! action('ContactController@datatableData') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'postal_code', name: 'postal_code' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>
@endpush
