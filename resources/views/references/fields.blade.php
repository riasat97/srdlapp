<!-- Ref Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ref_type', 'Ref Type:') !!}
    {!! Form::text('ref_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('references.index') }}" class="btn btn-default">Cancel</a>
</div>
