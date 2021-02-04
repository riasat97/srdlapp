
<div class="form-row">
    <!-- Name Field -->
    <div class="form-group col-md-6">
        {!! Form::label('name', 'নাম:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Designation -->
<div class="form-group col-sm-6">
    {{Form::label('designation', 'পদবি:') }}
    {{Form::select('designation', array('0' => 'নির্বাচন করুন','dc' => 'জেলা প্রশাসক', 'adc' => 'অতিরিক্ত জেলা প্রশাসক','uno'=>'উপজেলা নির্বাহী অফিসার','programmer'=>'প্রোগ্রামার','ap'=>'সহকারী প্রোগ্রামার','useo'=>'উপজেলা মাধ্যমিক শিক্ষা অফিসার','others'=>'অন্যান্য'), null,['class'=>'form-control', 'id'=>'designation'])}}
</div>
<!-- Posting Type -->
<div class="form-group col-sm-6">
    {{Form::label('posting_type', 'পোস্টিংয়ের ধরণ:') }}
    {{Form::select('posting_type', array('0' => 'নির্বাচন করুন','incharge' => 'ভারপ্রাপ্ত (মূল দায়িত্বে)', 'attached' => 'সংযুক্ত','additional'=>'অতিরিক্ত দায়িত্ব','others'=>'অন্যান্য'), null,['class'=>'form-control', 'id'=>'designation'])}}
</div>
<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'মোবাইল:') !!}
    {!! Form::number('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'ইমেইল:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
</div>
