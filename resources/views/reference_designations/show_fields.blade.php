<!-- Ref Designation Field -->
<div class="form-group">
    {!! Form::label('ref_designation', 'Ref Designation:') !!}
    <p>{{ $referenceDesignation->ref_designation }}</p>
</div>

<!-- Reference Id Field -->
<div class="form-group">
    {!! Form::label('reference_id', 'Reference Id:') !!}
    <p>{{ $referenceDesignation->reference_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $referenceDesignation->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $referenceDesignation->updated_at }}</p>
</div>

