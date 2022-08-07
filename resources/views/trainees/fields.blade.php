
<div class="form-row">
    <!-- 1st Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '১ম প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($lab))
            {!! Form::text('name[]', $lab->trainees[0]->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($lab))
            {{Form::select('designation[]', trainee_designations(), $lab->trainees[0]->designation,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        <div class="input-group date" id="age1">
        @if(!empty($lab))
            {{Form::text('age[]',$lab->trainees[0]->age,['class'=>'form-control', 'id'=>'date'])}}
        @else
            {{Form::text('age[]',null,['class'=>'form-control', 'id'=>'date'])}}
        @endif
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($lab))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[0]->gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>
    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($lab))
            {!! Form::tel('mobile[]', $lab->trainees[0]->mobile, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($lab))
            {!! Form::text('email[]', $lab->trainees[0]->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($lab))
            {{Form::select('qualification[]', qualifications(), $lab->trainees[0]->qualification,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>

    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($lab))
            {{Form::text('subject[]', $lab->trainees[0]->subject,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>
<div class="form-row">
    <!-- 2nd Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '২য় প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($lab))
            {!! Form::text('name[]', $lab->trainees[1]->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($lab))
            {{Form::select('designation[]', trainee_designations(), $lab->trainees[1]->designation,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        <div class="input-group date" id="age2">
            @if(!empty($lab))
                {{Form::text('age[]',$lab->trainees[1]->age,['class'=>'form-control', 'id'=>'date'])}}
            @else
                {{Form::text('age[]',null,['class'=>'form-control', 'id'=>'date'])}}
            @endif
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($lab))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[1]->gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>
    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($lab))
            {!! Form::tel('mobile[]', $lab->trainees[1]->mobile, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($lab))
            {!! Form::text('email[]', $lab->trainees[1]->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($lab))
            {{Form::select('qualification[]', qualifications(), $lab->trainees[1]->qualification,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>

    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($lab))
            {{Form::text('subject[]', $lab->trainees[1]->subject,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>

<div class="form-row">
    <!-- 3rd Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '৩য় প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($lab))
            {!! Form::text('name[]', $lab->trainees[2]->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($lab))
            {{Form::select('designation[]', trainee_designations(), $lab->trainees[2]->designation,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        <div class="input-group date" id="age3">
            @if(!empty($lab))
                {{Form::text('age[]',$lab->trainees[2]->age,['class'=>'form-control', 'id'=>'date'])}}
            @else
                {{Form::text('age[]',null,['class'=>'form-control', 'id'=>'date'])}}
            @endif
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($lab))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[2]->gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>
    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($lab))
            {!! Form::tel('mobile[]', $lab->trainees[2]->mobile, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($lab))
            {!! Form::text('email[]', $lab->trainees[2]->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($lab))
            {{Form::select('qualification[]', qualifications(), $lab->trainees[2]->qualification,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>

    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($lab))
            {{Form::text('subject[]', $lab->trainees[2]->subject,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>

<div class="form-row">
    <!-- 4th Name -->
    <div class="form-group col-sm-3">
        {!! Form::label('name', '৪র্থ প্রশিক্ষণার্থীর নাম (বাংলায়):') !!}
        @if(!empty($lab))
            {!! Form::text('name[]', $lab->trainees[3]->name, ['class' => 'form-control','placeholder'=>'বাংলাতে']) !!}
        @else
            {!! Form::text('name[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <!-- Designation -->
    <div class="form-group col-sm-3">
        {{Form::label('designation', 'পদবি:') }}
        @if(!empty($lab))
            {{Form::select('designation[]', trainee_designations(), $lab->trainees[3]->designation,['class'=>'form-control', 'id'=>'designation'])}}
        @else
            {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation'])}}
        @endif
    </div>
    {{--AGE--}}
    <div class="form-group col-sm-3">
        {{Form::label('age', 'বয়স:') }}
        <div class="input-group date" id="age4">
            @if(!empty($lab))
                {{Form::text('age[]',$lab->trainees[3]->age,['class'=>'form-control', 'id'=>'date'])}}
            @else
                {{Form::text('age[]',null,['class'=>'form-control', 'id'=>'date'])}}
            @endif
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    {{--gender--}}
    <div class="form-group col-sm-3">
        {{Form::label('gender', 'জেন্ডার:') }}
        @if(!empty($lab))
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[3]->gender,['class'=>'form-control', 'id'=>'gender'])}}
        @else
            {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control', 'id'=>'gender'])}}
        @endif
    </div>
    <!-- Mobile -->
    <div class="form-group col-sm-3">
        {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
        @if(!empty($lab))
            {!! Form::tel('mobile[]', $lab->trainees[3]->mobile, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @else
            {!! Form::tel('mobile[]', null, ['class' => 'form-control','pattern'=>"[0-9]{11}"]) !!}
        @endif
    </div>
    <!-- Email -->
    <div class="form-group col-sm-3">
        {!! Form::label('email', 'ইমেইল:') !!}
        @if(!empty($lab))
            {!! Form::text('email[]', $lab->trainees[3]->email, ['class' => 'form-control']) !!}
        @else
            {!! Form::email('email[]', null, ['class' => 'form-control']) !!}
        @endif
    </div>
    {{--Qualification--}}
    <div class="form-group col-sm-3">
        {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
        @if(!empty($lab))
            {{Form::select('qualification[]', qualifications(), $lab->trainees[3]->qualification,['class'=>'form-control', 'id'=>'qualification'])}}
        @else
            {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'id'=>'qualification'])}}
        @endif
    </div>

    {{--Subject--}}
    <div class="form-group col-sm-3">
        {{Form::label('subject', 'বিষয় (বাংলায়):') }}
        @if(!empty($lab))
            {{Form::text('subject[]', $lab->trainees[3]->subject,['class'=>'form-control', 'id'=>'subject'])}}
        @else
            {{Form::text('subject[]', null,['class'=>'form-control', 'id'=>'subject'])}}
        @endif
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('labs.trainees.edit',$lab->id) }}" class="btn btn-default">Cancel</a>
</div>
