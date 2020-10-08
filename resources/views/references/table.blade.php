<div class="table-responsive">
    <table class="table" id="references-table">
        <thead>
            <tr>
                <th>Ref Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($references as $reference)
            <tr>
                <td>{{ $reference->ref_type }}</td>
                <td>
                    {!! Form::open(['route' => ['references.destroy', $reference->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('references.show', [$reference->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('references.edit', [$reference->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
