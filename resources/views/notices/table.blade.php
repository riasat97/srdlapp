<div class="table-responsive">
    <table class="table" id="notices-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Download</th>
                <th>Published At</th>
                @if(!empty(Auth::user()) && Auth::user()->hasRole(['super admin']))
                <th colspan="3">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($notices as $notice)
            <tr>
                <td>{{ $notice->title }}</td>
                <td>
                @foreach($notice->attachments as $attachment)
                    <a href="{{ $attachment->file }}" target="_blank"> <i class="ri-file-pdf-line"></i></a>
                @endforeach
                </td>
                <td>{{ $notice->published_at }}</td>

                @if(!empty(Auth::user()) && Auth::user()->hasRole(['super admin']))
                <td>
                    {!! Form::open(['route' => ['notices.destroy', $notice->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
{{--                        <a href="{{ route('notices.show', [$notice->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                       {{-- <a href="{{ route('notices.edit', [$notice->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
