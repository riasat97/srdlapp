<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $notice->title }}</p>
</div>

<!-- File1 Field -->
<div class="form-group">
    {!! Form::label('file1', 'File1:') !!}
    <p>{{ $notice->file1 }}</p>
</div>

<!-- Published At Field -->
<div class="form-group">
    {!! Form::label('published_at', 'Published At:') !!}
    <p>{{ $notice->published_at }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $notice->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $notice->updated_at }}</p>
</div>

