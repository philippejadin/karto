<table class="table table-responsive">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Address</th>
        <th>Postal Code</th>
        <th>Locality</th>
        <th>Country</th>
        <th>Phone</th>
        <th>Phone2</th>
        <th>Website</th>
        <th>Email</th>
        <th>Public</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Uuid</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Deleted At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{!! $contact->name !!}</td>
            <td>{!! $contact->description !!}</td>
            <td>{!! $contact->address !!}</td>
            <td>{!! $contact->postal_code !!}</td>
            <td>{!! $contact->locality !!}</td>
            <td>{!! $contact->country !!}</td>
            <td>{!! $contact->phone !!}</td>
            <td>{!! $contact->phone2 !!}</td>
            <td>{!! $contact->website !!}</td>
            <td>{!! $contact->email !!}</td>
            <td>{!! $contact->public !!}</td>
            <td>{!! $contact->latitude !!}</td>
            <td>{!! $contact->longitude !!}</td>
            <td>{!! $contact->uuid !!}</td>
            <td>{!! $contact->created_at !!}</td>
            <td>{!! $contact->updated_at !!}</td>
            <td>{!! $contact->deleted_at !!}</td>
            <td>
                {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contacts.show', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contacts.edit', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>