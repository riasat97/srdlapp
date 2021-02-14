
<div class="form-row">
    <!-- Name Field -->
    <div class="form-group col-md-6">
        {!! Form::label('name', 'নাম (বাংলায়):') !!}
        @if(!empty($user))
            {!! Form::text('name', empty($name)?'':$user->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @endif
    </div>
</div>

<!-- Designation -->
<div class="form-group col-sm-6">
    {{Form::label('designation', 'পদবি:') }}
    @if(!empty($user))
        {{Form::select('designation', array('0' => 'নির্বাচন করুন','dc' => 'জেলা প্রশাসক', 'adc' => 'অতিরিক্ত জেলা প্রশাসক','uno'=>'উপজেলা নির্বাহী অফিসার'/*,'programmer'=>'প্রোগ্রামার','ap'=>'সহকারী প্রোগ্রামার','useo'=>'উপজেলা মাধ্যমিক শিক্ষা অফিসার','others'=>'অন্যান্য'*/), $designation_selected,['class'=>'form-control', 'id'=>'designation'])}}
    @else
        {{Form::select('designation', array('0' => 'নির্বাচন করুন','dc' => 'জেলা প্রশাসক', 'adc' => 'অতিরিক্ত জেলা প্রশাসক','uno'=>'উপজেলা নির্বাহী অফিসার'/*,'programmer'=>'প্রোগ্রামার','ap'=>'সহকারী প্রোগ্রামার','useo'=>'উপজেলা মাধ্যমিক শিক্ষা অফিসার','others'=>'অন্যান্য'*/), null,['class'=>'form-control', 'id'=>'designation'])}}
    @endif
</div>
<!-- Posting Type -->
{{--<div class="form-group col-sm-6">
    {{Form::label('posting_type', 'পোস্টিংয়ের ধরণ:') }}
    {{Form::select('posting_type', array('0' => 'নির্বাচন করুন','incharge' => 'ভারপ্রাপ্ত (মূল দায়িত্বে)', 'attached' => 'সংযুক্ত','additional'=>'অতিরিক্ত দায়িত্ব','others'=>'অন্যান্য'), null,['class'=>'form-control', 'id'=>'designation'])}}
</div>--}}
<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
    @if(!empty($user))
        {!! Form::tel('mobile', $user->mobile??'', ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
    @else
        {!! Form::tel('mobile', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
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
