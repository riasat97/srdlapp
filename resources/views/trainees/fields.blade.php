
<div class="form-row">
    <!-- Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '১ম প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($user))
            {!! Form::text('name[]', empty($name)?'':$user->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($user))
            {{Form::select('designation[]', trainee_designations(), $designation_selected,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        @if(!empty($user))
            {{Form::select('age[]', ages(), $age,['class'=>'form-control', 'id'=>'age'])}}
        @else
            {{Form::select('age[]', ages(), null,['class'=>'form-control', 'id'=>'age'])}}
        @endif
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($user))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], $gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>

    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($user))
            {!! Form::tel('mobile[]', $user->mobile??'', ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($user))
            {!! Form::text('email[]', empty($email)?'':$user->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($user))
            {{Form::select('qualification[]', qualifications(), $qualification_selected,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>
    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($user))
            {{Form::text('subject[]', $designation_selected,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>
<div class="form-row">
    <!-- Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '২য় প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($user))
            {!! Form::text('name[]', empty($name)?'':$user->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($user))
            {{Form::select('designation[]', trainee_designations(), $designation_selected,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        @if(!empty($user))
            {{Form::select('age[]', ages(), $age,['class'=>'form-control', 'id'=>'age'])}}
        @else
            {{Form::select('age[]', ages(), null,['class'=>'form-control', 'id'=>'age'])}}
        @endif
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($user))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], $gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>

    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($user))
            {!! Form::tel('mobile[]', $user->mobile??'', ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($user))
            {!! Form::text('email[]', empty($email)?'':$user->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($user))
            {{Form::select('qualification[]', qualifications(), $qualification_selected,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>
    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($user))
            {{Form::text('subject[]', $designation_selected,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>

<div class="form-row">
    <!-- Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '৩য় প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($user))
            {!! Form::text('name[]', empty($name)?'':$user->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($user))
            {{Form::select('designation[]', trainee_designations(), $designation_selected,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>

    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($user))
            {!! Form::tel('mobile[]', $user->mobile??'', ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($user))
            {!! Form::text('email[]', empty($email)?'':$user->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        @if(!empty($user))
            {{Form::select('age[]', ages(), $age,['class'=>'form-control', 'id'=>'age'])}}
        @else
            {{Form::select('age[]', ages(), null,['class'=>'form-control', 'id'=>'age'])}}
        @endif
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($user))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], $gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($user))
            {{Form::select('qualification[]', qualifications(), $qualification_selected,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>
    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($user))
            {{Form::text('subject[]', $designation_selected,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>

<div class="form-row">
    <!-- Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '৪র্থ প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($user))
            {!! Form::text('name[]', empty($name)?'':$user->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($user))
            {{Form::select('designation[]', trainee_designations(), $designation_selected,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        @if(!empty($user))
            {{Form::select('age[]', ages(), $age,['class'=>'form-control', 'id'=>'age'])}}
        @else
            {{Form::select('age[]', ages(), null,['class'=>'form-control', 'id'=>'age'])}}
        @endif
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($user))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], $gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','পুরুষ','মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>

    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($user))
            {!! Form::tel('mobile[]', $user->mobile??'', ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($user))
            {!! Form::text('email[]', empty($email)?'':$user->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($user))
            {{Form::select('qualification[]', qualifications(), $qualification_selected,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>
    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($user))
            {{Form::text('subject[]', $designation_selected,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('labs.trainees.update',$institution->id) }}" class="btn btn-default">Cancel</a>
</div>
