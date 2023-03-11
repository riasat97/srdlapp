
<div class="form-row">
    <!-- 1st Name -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">১ম প্রশিক্ষণার্থীর তথ্য</h3>
        </div>
        <div class="panel-body">
            {{--Name--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (বাংলায়):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() )
                    {!! Form::text('name[]', $lab->trainees[0]->name, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @endif
            </div>
            {{--Name in English--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() )
                    {!! Form::text('name_en[]', $lab->trainees[0]->name_en, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
                @else
                    {!! Form::text('name_en[]', null, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
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
                {{Form::label('subject', 'পাঠদানের বিষয় (ENGLISH):') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[0]->subject,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- Math'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- Math'])}}
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
                        {{Form::text('dob[]',$lab->trainees[0]->dob,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
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
                    {!! Form::tel('mobile[]', $lab->trainees[0]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
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
            {{--NID--}}
            <div class="form-group col-sm-3">
                {!! Form::label('nid', 'NID (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty())
                    {!! Form::text('nid[]', $lab->trainees[0]->nid, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @else
                    {!! Form::email('nid[]', null, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @endif
            </div>
            {{--ICT Training--}}
            <div class="form-group col-sm-3" style="">
                {{ Form::label('ict_training1', 'আইসিটি বিষয়ক কোনো প্রশিক্ষণ সম্পন্ন করা আছে কিনা?') }}
                <input name="training[]"
                       @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[0]->training_title )checked
                       @endif id="ict_training1" type="checkbox" data-width="50"
                       class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না"
                       data-onstyle="success" data-offstyle="danger">
            </div>
            <div class="form-group col-sm-3" id="ict_training1_title_label">
                {!! Form::label('ict_training1_title', 'প্রশিক্ষণের নাম:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[0]->training_title)
                    {!! Form::text('training_title[]', $lab->trainees[0]->training_title, ['class' => 'form-control','','id'=>'ict_training1_title']) !!}
                @else
                    {!! Form::text('training_title[]', null, ['class' => 'form-control','','id'=>'ict_training1_title']) !!}
                @endif
            </div>
            <div class="form-group col-sm-3" id="ict_training1_duration_label">
                {!! Form::label('ict_training1_duration', 'প্রশিক্ষণের মেয়াদ (কত দিন):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[0]->training_duration)
                    {!! Form::text('training_duration[]', $lab->trainees[0]->training_duration, ['class' => 'form-control','','id'=>'ict_training1_duration','placeholder'=>' দিন সংখ্যা']) !!}
                @else
                    {!! Form::text('training_duration[]', null, ['class' => 'form-control','','id'=>'ict_training1_duration','placeholder'=>' দিন সংখ্যা']) !!}
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
                    {!! Form::text('name[]', $lab->trainees[1]->name, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @endif
            </div>
            {{--Name in English--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() )
                    {!! Form::text('name_en[]', $lab->trainees[1]->name_en, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
                @else
                    {!! Form::text('name_en[]', null, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
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
                {{Form::label('subject', 'পাঠদানের বিষয় (ENGLISH):') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[1]->subject,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- ICT'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- ICT'])}}
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
                        {{Form::text('dob[]',$lab->trainees[1]->dob,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
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
                    {!! Form::tel('mobile[]', $lab->trainees[1]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
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
            {{--NID--}}
            <div class="form-group col-sm-3">
                {!! Form::label('nid', 'NID (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty())
                    {!! Form::text('nid[]', $lab->trainees[1]->nid, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @else
                    {!! Form::email('nid[]', null, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @endif
            </div>
            {{--ICT Training--}}
            <div class="form-group col-sm-3" style="">
                {{ Form::label('ict_training2', 'আইসিটি বিষয়ক কোনো প্রশিক্ষণ সম্পন্ন করা আছে কিনা?') }}
                <input name="training[]"
                       @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[1]->training_title )checked
                       @endif id="ict_training2" type="checkbox" data-width="50"
                       class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না"
                       data-onstyle="success" data-offstyle="danger">
            </div>
            <div class="form-group col-sm-3" id="ict_training2_title_label">
                {!! Form::label('ict_training2_title', 'প্রশিক্ষণের নাম:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[1]->training_title)
                    {!! Form::text('training_title[]', $lab->trainees[1]->training_title, ['class' => 'form-control','','id'=>'ict_training2_title']) !!}
                @else
                    {!! Form::text('training_title[]', null, ['class' => 'form-control','','id'=>'ict_training2_title']) !!}
                @endif
            </div>
            <div class="form-group col-sm-3" id="ict_training2_duration_label">
                {!! Form::label('ict_training2_duration', 'প্রশিক্ষণের মেয়াদ (কত দিন):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[1]->training_duration)
                    {!! Form::text('training_duration[]', $lab->trainees[1]->training_duration, ['class' => 'form-control','','id'=>'ict_training2_duration','placeholder'=>' দিন সংখ্যা']) !!}
                @else
                    {!! Form::text('training_duration[]', null, ['class' => 'form-control','','id'=>'ict_training2_duration','placeholder'=>' দিন সংখ্যা']) !!}
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
                    {!! Form::text('name[]', $lab->trainees[2]->name, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @endif
            </div>
            {{--Name in English--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() )
                    {!! Form::text('name_en[]', $lab->trainees[2]->name_en, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
                @else
                    {!! Form::text('name_en[]', null, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
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
                {{Form::label('subject', 'পাঠদানের বিষয় (ENGLISH):') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[2]->subject,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- Science'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- Science'])}}
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
                        {{Form::text('dob[]',$lab->trainees[2]->dob,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
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
                    {!! Form::tel('mobile[]', $lab->trainees[2]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
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
            {{--NID--}}
            <div class="form-group col-sm-3">
                {!! Form::label('nid', 'NID (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty())
                    {!! Form::text('nid[]', $lab->trainees[2]->nid, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @else
                    {!! Form::email('nid[]', null, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @endif
            </div>
            {{--ICT Training--}}
            <div class="form-group col-sm-3" style="">
                {{ Form::label('ict_training3', 'আইসিটি বিষয়ক কোনো প্রশিক্ষণ সম্পন্ন করা আছে কিনা?') }}
                <input name="training[]"
                       @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[2]->training_title )checked
                       @endif id="ict_training3" type="checkbox" data-width="50"
                       class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না"
                       data-onstyle="success" data-offstyle="danger">
            </div>
            <div class="form-group col-sm-3" id="ict_training3_title_label">
                {!! Form::label('ict_training3_title', 'প্রশিক্ষণের নাম:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[2]->training_title)
                    {!! Form::text('training_title[]', $lab->trainees[2]->training_title, ['class' => 'form-control','','id'=>'ict_training3_title']) !!}
                @else
                    {!! Form::text('training_title[]', null, ['class' => 'form-control','','id'=>'ict_training3_title']) !!}
                @endif
            </div>
            <div class="form-group col-sm-3" id="ict_training3_duration_label">
                {!! Form::label('ict_training3_duration', 'প্রশিক্ষণের মেয়াদ (কত দিন):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[2]->training_duration)
                    {!! Form::text('training_duration[]', $lab->trainees[2]->training_duration, ['class' => 'form-control','','id'=>'ict_training3_duration','placeholder'=>' দিন সংখ্যা']) !!}
                @else
                    {!! Form::text('training_duration[]', null, ['class' => 'form-control','','id'=>'ict_training3_duration','placeholder'=>' দিন সংখ্যা']) !!}
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
            {{--Name--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (বাংলায়):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {!! Form::text('name[]', $lab->trainees[3]->name, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @else
                    {!! Form::text('name[]', null, ['class' => 'form-control','required','placeholder'=>'বাংলায়']) !!}
                @endif
            </div>
            {{--Name in English--}}
            <div class="form-group col-sm-3">
                {!! Form::label('name', 'নাম (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() )
                    {!! Form::text('name_en[]', $lab->trainees[3]->name_en, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
                @else
                    {!! Form::text('name_en[]', null, ['class' => 'form-control','required','placeholder'=>'ইংরেজিতে']) !!}
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
                {{Form::label('subject', 'পাঠদানের বিষয় (ENGLISH):') }}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && !empty($lab->trainees))
                    {{Form::text('subject[]', $lab->trainees[3]->subject,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- English'])}}
                @else
                    {{Form::text('subject[]', null,['class'=>'form-control','required', 'id'=>'subject','placeholder'=>'Ex- English'])}}
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
                        {{Form::text('dob[]',$lab->trainees[3]->dob,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
                    @else
                        {{Form::text('dob[]',null,['class'=>'form-control','required', 'id'=>'date','placeholder'=>'1965-04-27'])}}
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
                    {!! Form::tel('mobile[]', $lab->trainees[3]->mobile, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
                @else
                    {!! Form::tel('mobile[]', null, ['class' => 'form-control','required','pattern'=>"[0-9]{11}",'placeholder'=>'01xxxxxxxxx']) !!}
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
            {{--NID--}}
            <div class="form-group col-sm-3">
                {!! Form::label('nid', 'NID (ENGLISH):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty())
                    {!! Form::text('nid[]', $lab->trainees[3]->nid, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @else
                    {!! Form::email('nid[]', null, ['class' => 'form-control','required','pattern'=>"^([0-9]{10}|[0-9]{13}|[0-9]{17})$"]) !!}
                @endif
            </div>
            {{--ICT Training--}}
            <div class="form-group col-sm-3" style="">
                {{ Form::label('ict_training4', 'আইসিটি বিষয়ক কোনো প্রশিক্ষণ সম্পন্ন করা আছে কিনা?') }}
                <input name="training[]"
                       @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[3]->training_title )checked
                       @endif id="ict_training4" type="checkbox" data-width="50"
                       class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না"
                       data-onstyle="success" data-offstyle="danger">
            </div>
            <div class="form-group col-sm-3" id="ict_training4_title_label">
                {!! Form::label('ict_training4_title', 'প্রশিক্ষণের নাম:') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[3]->training_title)
                    {!! Form::text('training_title[]', $lab->trainees[3]->training_title, ['class' => 'form-control','','id'=>'ict_training4_title']) !!}
                @else
                    {!! Form::text('training_title[]', null, ['class' => 'form-control','','id'=>'ict_training4_title']) !!}
                @endif
            </div>
            <div class="form-group col-sm-3" id="ict_training4_duration_label">
                {!! Form::label('ict_training4_duration', 'প্রশিক্ষণের মেয়াদ (কত দিন):') !!}
                @if(!empty($lab) && $lab->trainees->isNotEmpty() && $lab->trainees[3]->training_duration)
                    {!! Form::text('training_duration[]', $lab->trainees[3]->training_duration, ['class' => 'form-control','','id'=>'ict_training4_duration','placeholder'=>' দিন সংখ্যা']) !!}
                @else
                    {!! Form::text('training_duration[]', null, ['class' => 'form-control','','id'=>'ict_training4_duration','placeholder'=>' দিন সংখ্যা']) !!}
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

