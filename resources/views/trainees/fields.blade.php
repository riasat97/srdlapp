
<div class="form-row">
    <!-- 1st Name -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">১ম প্রশিক্ষণার্থীর তথ্য</h3>
        </div>
        <div class="panel-body">
            {{--            Name--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (বাংলায়):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() )
                    {!! Form::text('name[]', $lab->trainees[0]->name, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>
            <!-- Designation -->
            <div class="form-group col-sm-3">
                {{Form::label('designation', 'পদবি:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('designation[]', trainee_designations(), $lab->trainees[0]->designation,['class'=>'form-control', 'id'=>'designation','required'])}}
                @else
                    {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation','required'])}}
                @endif
            </div>
            {{--Subject--}}
            <div class="form-group col-sm-3">
                {{Form::label('subject', 'বিষয়:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[0]->subject,['class'=>'form-control','required', 'id'=>'subject'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject'])}}
                @endif
            </div>
            {{--Qualification--}}
            <div class="form-group col-sm-3">
                {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('qualification[]', qualifications(), $lab->trainees[0]->qualification,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @else
                    {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @endif
            </div>
            {{--AGE--}}
            <div class="form-group col-sm-3">
                {{Form::label('dob', 'জন্ম তারিখ (বছর-মাস-দিন):') }}
                <div class="input-group date" id="dob1">
                    @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                        {{Form::text('dob[]',$lab->trainees[0]->dob,['class'=>'form-control','required', 'id'=>'date'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date'])}}
                    @endif
                    <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
                </div>
            </div>
            {{--gender--}}
            <div class="form-group col-sm-3">
                {{Form::label('gender', 'জেন্ডার:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[0]->gender,['class'=>'form-control','required', 'id'=>'gender'])}}
                @else
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control','required', 'id'=>'gender'])}}
                @endif
            </div>
            <!-- Mobile -->
            <div class="form-group col-sm-3">
                {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::tel('mobile[]', $lab->trainees[0]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @endif
            </div>
            <!-- Email -->
            <div class="form-group col-sm-3">
                {!! Form::label('email', 'ইমেইল:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('email[]', $lab->trainees[0]->email, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::email('email[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <!-- 2nd Name -->
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">২য় প্রশিক্ষণার্থীর তথ্য</h3>
        </div>
        <div class="panel-body">
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (বাংলায়):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('name[]', $lab->trainees[1]->name, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>
            <!-- Designation -->
            <div class="form-group col-sm-3">
                {{Form::label('designation', 'পদবি:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('designation[]', trainee_designations(), $lab->trainees[1]->designation,['class'=>'form-control', 'id'=>'designation','required'])}}
                @else
                    {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation','required'])}}
                @endif
            </div>
            <!--Subject-->
            <div class="form-group col-sm-3">
                {{Form::label('subject', 'বিষয়:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[1]->subject,['class'=>'form-control','required', 'id'=>'subject'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject'])}}
                @endif
            </div>
            <!--Qualification-->
            <div class="form-group col-sm-3">
                {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('qualification[]', qualifications(), $lab->trainees[1]->qualification,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @else
                    {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @endif
            </div>
            <!--AGE-->
            <div class="form-group col-sm-3">
                {{Form::label('dob', 'জন্ম তারিখ (বছর-মাস-দিন):') }}
                <div class="input-group date" id="dob2">
                    @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                        {{Form::text('dob[]',$lab->trainees[1]->dob,['class'=>'form-control','required', 'id'=>'date'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date'])}}
                    @endif
                    <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
                </div>
            </div>
            <!--gender-->
            <div class="form-group col-sm-3">
                {{Form::label('gender', 'জেন্ডার:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[1]->gender,['class'=>'form-control','required', 'id'=>'gender'])}}
                @else
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control','required', 'id'=>'gender'])}}
                @endif
            </div>
            <!-- Mobile -->
            <div class="form-group col-sm-3">
                {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::tel('mobile[]', $lab->trainees[1]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @endif
            </div>
            <!-- Email -->
            <div class="form-group col-sm-3">
                {!! Form::label('email', 'ইমেইল:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('email[]', $lab->trainees[1]->email, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::email('email[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>


        </div>
    </div>

</div>

<div class="form-row">
    <!-- 3rd Name -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">৩য় প্রশিক্ষণার্থীর তথ্য </h3>
        </div>
        <div class="panel-body">
            {{--            Name--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (বাংলায়):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('name[]', $lab->trainees[2]->name, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>
            <!-- Designation -->
            <div class="form-group col-sm-3">
                {{Form::label('designation', 'পদবি:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('designation[]', trainee_designations(), $lab->trainees[2]->designation,['class'=>'form-control', 'id'=>'designation','required'])}}
                @else
                    {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation','required'])}}
                @endif
            </div>
            {{--            Subject--}}
            <div class="form-group col-sm-3">
                {{Form::label('subject', 'বিষয়:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[2]->subject,['class'=>'form-control','required', 'id'=>'subject'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject'])}}
                @endif
            </div>
            {{--            Qualification--}}
            <div class="form-group col-sm-3">
                {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('qualification[]', qualifications(), $lab->trainees[2]->qualification,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @else
                    {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @endif
            </div>
            {{--            AGE--}}
            <div class="form-group col-sm-3">
                {{Form::label('dob', 'জন্ম তারিখ (বছর-মাস-দিন):') }}
                <div class="input-group date" id="dob3">
                    @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                        {{Form::text('dob[]',$lab->trainees[2]->dob,['class'=>'form-control','required', 'id'=>'date'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date'])}}
                    @endif
                    <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
                </div>
            </div>
            {{--            gender--}}
            <div class="form-group col-sm-3">
                {{Form::label('gender', 'জেন্ডার:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[2]->gender,['class'=>'form-control','required', 'id'=>'gender'])}}
                @else
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control','required', 'id'=>'gender'])}}
                @endif
            </div>
            <!-- Mobile -->
            <div class="form-group col-sm-3">
                {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::tel('mobile[]', $lab->trainees[2]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @endif
            </div>
            <!-- Email -->
            <div class="form-group col-sm-3">
                {!! Form::label('email', 'ইমেইল:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('email[]', $lab->trainees[2]->email, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::email('email[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>


        </div>
    </div>

</div>

<div class="form-row">
    <!-- 4th Name -->
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">৪র্থ প্রশিক্ষণার্থীর তথ্য </h3>
        </div>
        <div class="panel-body">
            {{--            Name--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (বাংলায়):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('name[]', $lab->trainees[3]->name, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>
            <!-- Designation -->
            <div class="form-group col-sm-3">
                {{Form::label('designation', 'পদবি:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('designation[]', trainee_designations(), $lab->trainees[3]->designation,['class'=>'form-control', 'id'=>'designation','required'])}}
                @else
                    {{Form::select('designation[]', trainee_designations(), null,['class'=>'form-control', 'id'=>'designation','required'])}}
                @endif
            </div>
            {{--            Subject--}}
            <div class="form-group col-sm-3">
                {{Form::label('subject', 'বিষয়:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[3]->subject,['class'=>'form-control','required', 'id'=>'subject'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject'])}}
                @endif
            </div>
            {{--            Qualification--}}
            <div class="form-group col-sm-3">
                {{Form::label('qualification', 'সর্বোচ্চ শিক্ষাগত যোগ্যতা:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('qualification[]', qualifications(), $lab->trainees[3]->qualification,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @else
                    {{Form::select('qualification[]', qualifications(), null,['class'=>'form-control', 'required','id'=>'qualification'])}}
                @endif
            </div>
            {{--            AGE--}}
            <div class="form-group col-sm-3">
                {{Form::label('dob', 'জন্ম তারিখ (বছর-মাস-দিন):') }}
                <div class="input-group date" id="dob4">
                    @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                        {{Form::text('dob[]',$lab->trainees[3]->dob,['class'=>'form-control','required', 'id'=>'date'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date'])}}
                    @endif
                    <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
                </div>
            </div>
            {{--            gender--}}
            <div class="form-group col-sm-3">
                {{Form::label('gender', 'জেন্ডার:') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], $lab->trainees[3]->gender,['class'=>'form-control','required', 'id'=>'gender'])}}
                @else
                    {{Form::select('gender[]', ['0' => 'নির্বাচন করুন','male'=>'পুরুষ','female'=>'মহিলা'], null,['class'=>'form-control','required', 'id'=>'gender'])}}
                @endif
            </div>
            <!-- Mobile -->
            <div class="form-group col-sm-3">
                {!! Form::label('mobile', 'মোবাইল (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::tel('mobile[]', $lab->trainees[3]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}"]) !!}
                @endif
            </div>
            <!-- Email -->
            <div class="form-group col-sm-3">
                {!! Form::label('email', 'ইমেইল:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('email[]', $lab->trainees[3]->email, ['class' => 'form-control','required']) !!}
                @else
                    {!! Form::email('email[]', null, ['class' => 'form-control','required']) !!}
                @endif
            </div>

        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-row">
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit('সংরক্ষণ', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('labs.trainees.edit',$lab->id) }}" class="btn btn-default">বাতিল </a>
    </div>
</div>

