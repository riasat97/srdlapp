<!-- Ref Designation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ref_designation', 'Ref Designation:') !!}
    {!! Form::text('ref_designation', null, ['class' => 'form-control']) !!}
</div>

<!-- Reference Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference_id', 'Reference Id:') !!}
    {!! Form::select('reference_id', $referenceItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('referenceDesignations.index') }}" class="btn btn-default">Cancel</a>
</div>
