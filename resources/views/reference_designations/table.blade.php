<div class="table-responsive">
    <table class="table" id="referenceDesignations-table">
        <thead>
            <tr>
                <th>Ref Designation</th>
        <th>Reference Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($referenceDesignations as $referenceDesignation)
            <tr>
                <td>{{ $referenceDesignation->ref_designation }}</td>
            <td>{{ $referenceDesignation->reference_id }}</td>
                <td>
                    {!! Form::open(['route' => ['referenceDesignations.destroy', $referenceDesignation->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('referenceDesignations.show', [$referenceDesignation->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('referenceDesignations.edit', [$referenceDesignation->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
