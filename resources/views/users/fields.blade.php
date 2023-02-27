
<div class="form-row">
    <!-- Name Field -->
    <div class="form-group {{$isPap?'col-md-4':'col-md-6'}} ">
        {!! Form::label('name', $user->hasRole(['vendor'])?'নাম (English):':'নাম (বাংলায়):') !!}
        @if(!empty($user))
            {!! Form::text('name', empty($name)?'':$user->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @endif
    </div>
</div>

<!-- Designation -->
@if(!$user->hasRole(['vendor']))
<div class="form-group {{$isPap?'col-md-4':'col-md-6'}}">
    {{Form::label('designation', 'পদবি:') }}
    @if(!empty($user))
        {{Form::select('designation', $designations, $designation_selected,['class'=>'form-control', 'id'=>'designation'])}}
    @else
        {{Form::select('designation', $designations, null,['class'=>'form-control', 'id'=>'designation'])}}
    @endif
</div>
@endif

<!-- Posting Type -->
@if($user->hasRole(['district','upazila']))
<div class="form-group col-md-4">
    {{Form::label('posting_type', 'পোস্টিংয়ের ধরণ:') }}
    {{Form::select('posting_type', array('0' => 'নির্বাচন করুন','main' => 'মূল দায়িত্ব', 'attached' => 'সংযুক্ত','additional'=>'অতিরিক্ত দায়িত্ব'), $user->posting_type,['class'=>'form-control', 'id'=>'posting_type'])}}
</div>
@endif
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
    @if(!empty($user))
        {!! Form::tel('mobile', $user->mobile??'', ['class' => 'form-control','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
    @else
        {!! Form::tel('mobile', null, ['class' => 'form-control','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
    @endif
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'ইমেইল:') !!}
    @if(!empty($user))
        {!! Form::text('email', empty($email)?'':$user->email, ['class' => 'form-control']) !!}
    @else
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
</div>
