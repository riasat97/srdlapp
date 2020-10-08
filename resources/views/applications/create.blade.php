@extends('base')
@section('title', 'SRDL APPLICATION')

@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('main')

    <div class="main">
        <div class="container main-container">
            <div class="row">
                <div class="col-md-12 top-banner">
                    <img src="{{ asset("images/srdl_04.jpg") }}" alt="" class="img-responsive">
                </div>
            </div>

            <div class="col-md-12 top-heading">
                <h2>অনলাইনে কম্পিউটার ল্যাবের জন্য আবেদন করুন  </h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-12 application-form">
                {{Form::open(array('route' => 'applications.store','method' => 'post','id'=>'signup-form','class'=>'signup-form','files' => true))}}
                @csrf

                <h3>
                    <span class="title_text">শিক্ষা প্রতিষ্ঠানের বিবরণ</span>
                </h3>

                <fieldset class="tab_1">
                    <div class="fieldset-content">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">কম্পিউটার ল্যাবের ধরণ</label>
                                {{Form::select('lab_type', array('srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার'), old('lab_type'),['class'=>'form-control', 'id'=>'lab_type',])}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">প্রতিষ্ঠানের ধরন</label>
                                {{Form::select('institution_type', array('school' => 'স্কুল', 'college' => 'কলেজ', 'school and college'=> "স্কুল ও কলেজ", 'madrasha'=> "মাদ্রাসা",'technical'=>"টেকনিক্যাল",'primary'=>'প্রাইমারি','university'=>'বিশ্ববিদ্যালয়','gov_training'=>"সরকারি ট্রেনিং সেন্টার",'gov_rel_ins'=>"শিক্ষা সংশ্লিষ্ট সরকারি প্রতিষ্ঠান",'others'=>"অন্যান্য"), old('institution_type'),['class'=>'form-control', 'id'=>'institution_type',])}}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">শিক্ষা প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control" id="inputInsBn" name="institution_bn" value="{{ old('institution_bn') }}" placeholder="বাংলাতে">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group  col-md-6">
                                {{Form::label('div', 'বিভাগ') }}
                                {{ Form::select('division', $divisionList,old('division'),array('class'=>'form-control','id'=>'div','style'=>'width:350px;')) }}
                            </div>

                            <div class="form-group  col-md-6">
                                {{Form::label('dis', 'জেলা') }}
                                {{Form::select('district', [old('district')=>old('district')], old('district'),['id'=>'dis','class'=>'form-control','style'=>'width:350px;'])}}
                                {{--                        <select name="district" id="dis" class="form-control" style="width:350px">--}}
                                {{--                        </select>--}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{Form::label('upazila', 'উপজেলা') }}
                                {{Form::select('upazila', [old('upazila')=>old('upazila')], old('upazila'),['id'=>'upazila','class'=>'form-control','style'=>'width:350px;'])}}
                            </div>
                            <div class="form-group  col-md-6">
                                {{Form::label('union_pourashava_ward', 'ইউনিয়ন/পৌরসভা/ওয়ার্ড ') }}
                                {{Form::select('union_pourashava_ward', [old('union_pourashava_ward')=>old('union_pourashava_ward')], old('union_pourashava_ward'),['id'=>'union_pourashava_ward','class'=>'form-control','style'=>'width:350px;'])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                {{Form::label('seat_type', 'সংসদীয় আসনের ধরণ') }}
                                {{Form::select('seat_type', ['general'=>'সাধারণ', 'reserved'=>'সংরক্ষিত মহিলা আসন'], old('seat_type'),['id'=>'seat_type','class'=>'form-control'])}}
                            </div>
                            <div class="form-group  col-md-2">
                                {{Form::label('seat_no', 'সংসদীয় আসন নং:'.old('seat_no'),array('id' => 'seat-no')) }}
{{--                                {{Form::hidden('seat_no',old('seat_no'),["id"=>"hidden_seat_no"])}}--}}
                                <input type="hidden" name="seat_no" value="{{ old('seat_no') }}" id="hidden_seat_no">
                            </div>

                            <div class="form-group  col-md-4">
                                {{Form::label('parliamentary_constituency', 'নির্বাচনী এলাকার নাম') }}
                                {{Form::select('parliamentary_constituency', [old('parliamentary_constituency')=>old('parliamentary_constituency')], old('parliamentary_constituency'),['id'=>'parliamentary_constituency','class'=>'form-control','style'=>'width:350px;'])}}
                            </div>
                            <div class="form-group col-md-2" id="hidethis" style="display: none">
                                {{ Form::label('is_parliamentary_constituency_ok', 'নির্বাচনী এলাকাটি সঠিক?') }}
                                <input name="is_parliamentary_constituency_ok" id="is_parliamentary_constituency_ok" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_is_parliamentary_constituency_ok',"No",["id"=>"hidden_is_parliamentary_constituency_ok"])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
{{--                                {{ Form::label('reference', 'আধা-সরকারি পত্র সংখ্যা:- ৫৬.০০.০০০০.০০৬.৯৯.০০৩.২০-৪২৫/৪২৬ এর প্রেক্ষিতে সুপারিশ প্রাপ্ত?') }}--}}
                                {{ Form::label('listed_by_deo', 'আধা-সরকারি পত্রের (৪২৫/৪২৬) প্রেক্ষিতে তালিকা ভুক্ত?') }}
                                <input name="listed_by_deo" id="listed_by_deo" type="checkbox" data-width="50" class="toggle form-control" data-width="100" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            </div>
                            <div class="form-group  col-md-6 member_name" style="display: none">
                                {{ Form::label('member_name', 'মাননীয় সংসদ সদস্যের নাম') }}
                                {{ Form::text('member_name',old('member_name'),['id'=>'member_name','class'=>'form-control','placeholder'=>'']) }}
                            </div>
                        </div>
                        <div class="form-row list_attachment" style="display: none">

                                <div class="form-group col-md-2">
                                    {{ Form::label('list_attachment', 'প্রেরিত তালিকার স্ক্যান কপি (পিডিএফ)') }}
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="list_attachment_file">
                                        <input type="file" name="list_attachment_file"  class="custom-file-input" id="list_attachment_file">
                                        <label class="custom-file-label" for="list_attachment_file"></label>
                                    </div>
                                </div>

                            {{--<div class="form-group col-md-6">--}}
                            {{--{{ Form::label('ref_type', 'সুপারিশকারীর পরিচয়') }}--}}
                            {{--{{ Form::select('ref_type',array('public_representative' => 'জন প্রতিনিধি', 'govt_emp' => 'সরকারি কর্মকর্তা',"famous_personel"=>"প্রখ্যাত ব্যক্তিত্ব","others"=>"অন্যান্য "), null,['class' => 'form-control',"disabled"=>"true"]) }}--}}
                            {{--</div>--}}
                        </div>
                        <div class="step2">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">EIIN নম্বর</label>
                                    {{ Form::number('eiin',null,['class'=>'form-control', 'id'=>"eiin"])}}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('mpo', 'MPO কোড ') }}
                                    {{ Form::number('mpo',null,['class'=>'form-control', 'id'=>"mpo"])}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">শিক্ষা প্রতিষ্ঠানের নাম</label>
                                    <input type="text" class="form-control" id="inputInsEn" name="institution" value="{{ old('institution') }}" placeholder="ইংরেজিতে">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">প্রতিষ্ঠান প্রধানের নাম</label>
                                    <input type="text" class="form-control" id="head_name" name="head_name" value="{{ old('head_name') }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">প্রতিষ্ঠানের ইমেইল</label>
                                    <input type="email" class="form-control" id="institution_email" name="institution_email" placeholder="example@mail.com">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">প্রতিষ্ঠানের মোবাইল নম্বর</label>
                                    <input type="tel" pattern="[0-9]{11}" class="form-control" id="institution_tel" name="institution_tel" placeholder="01xxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    {{ Form::label('total_boys', 'মোট ছাত্র ') }}
    {{--                                {{ Form::selectRange('total_boys', 1, 5000,25,['class'=>'form-control', 'id'=>'total_boys'] )}}--}}
                                    {{ Form::number('total_boys', 0,['class'=>'form-control', 'id'=>'total_boys'] )}}
                                </div>

                                <div class="form-group  col-md-6">
                                    {{ Form::label('total_girls', 'মোট ছাত্রী') }}
    {{--                                {{ Form::selectRange('total_girls', 1, 5000,30,['class'=>'form-control', 'id'=>'total_girls'] )}}--}}
                                    {{ Form::number('total_girls', 0,['class'=>'form-control', 'id'=>'total_girls'] )}}
                                </div>

{{--                                <div class="form-group  col-md-4">--}}
{{--                                    {{ Form::label('total_teachers', 'মোট শিক্ষক') }}--}}
{{--    --}}{{--                                {{ Form::selectRange('total_teachers', 1, 500,30,['class'=>'form-control', 'id'=>'total_teachers'] )}}--}}
{{--                                    {{ Form::number('total_teachers', 0,['class'=>'form-control', 'id'=>'total_teachers'] )}}--}}
{{--                                </div>--}}
                            </div>

                            <div class="form-row">

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('internet_connection', 'ইন্টারনেট সংযোগ আছে ?', array('class' => 'awesome')) }}
                                    <input name="internet_connection" id="internet_connection" type="checkbox"  data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                    {{Form::hidden('hidden_internet_connection',"NO",["id"=>"hidden_internet_connection"])}}
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('internet_connection_type', 'ইন্টারনেট সংযোগের ধরন ?') }}
                                    {{Form::select('internet_connection_type', array('modem' => 'মডেম', 'broadband' => 'ব্রডব্যান্ড'), null,['class'=>'form-control', 'id'=>'internet_connection_type','class' => 'form-control',"disabled"=>"true"])}}
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="form-group  col-md-6">
                                    {{ Form::label('good_result', 'প্রতিষ্ঠানটি ভালো ফলাফলকারী (বিশেষ করে ইংরেজি, গণিত এবং বিজ্ঞান বিষয়ে)?', array('class' => 'awesome')) }}
                                    <input name="good_result" id="good_result" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                    {{Form::hidden('hidden_good_result',"NO",["id"=>"hidden_good_result"])}}
                                </div>
                                <div class="form-group  col-md-6">
                                    {{ Form::label('ict_teacher', 'আইসিটি শিক্ষক আছে ?') }}
                                    <input name="ict_teacher" id="ict_teacher" type="checkbox"  data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                    {{Form::hidden('hidden_ict_teacher',"NO",["id"=>"hidden_ict_teacher"])}}
                                </div>
                            </div>
                            <div class="form-row col-md-12">
                                <div class="form-group shadow-textarea">
                                    <label class="awesome" for="about_institution">প্রতিষ্ঠানটি সম্পর্কে আপনার মন্তব্য</label>
                                    <textarea class="form-control z-depth-1" id="about_institution" name="about_institution" rows="5" placeholder=""></textarea>
                                </div>
                            </div>
                            {{--management and student type start--}}
{{--                            <div class="form-row">--}}
{{--                                <div class="form-group  col-md-6">--}}
{{--                                    {{ Form::label('management', 'ম্যানেজমেন্ট') }}--}}
{{--                                    {{Form::select('management', array('GOVERNMENT' => 'সরকারি', 'NON-GOVT.' => 'বেসরকারি'), null,['id'=>'management','class' => 'form-control'])}}--}}
{{--                                </div>--}}

{{--                                <div class="form-group  col-md-6">--}}
{{--                                    {{Form::label('student_type', 'শিক্ষার্থীর ধরণ ') }}--}}
{{--                                    {{Form::select('student_type', array('CO-EDUCATION JOINT' => 'কো-এডুকেশন', 'BOYS' => 'বয়েজ','GIRLS'=>'গার্লস'), null,['id'=>'student_type','class' => 'form-control'])}}--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        {{--management and student type end--}}
                    </div>
                    <div class="form-group col-md-12" style="display: none" id="submit">
                        <button class="submitbtn btn btn-primary" id="submitbtn"type="submit">Submit</button>
                    </div>
                    <div class="fieldset-footer">
                        <span>Step 1 of 3</span>
                    </div>
                </fieldset>


{{--                <h3 class="step">--}}
{{--                    <span class="title_text">কম্পিউটার ল্যাব </span>--}}
{{--                </h3>--}}

{{--                <fieldset class="tab_2">--}}
{{--                    <div class="fieldset-content">--}}
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group  col-md-5">--}}
{{--                                {{ Form::label('own_lab', 'প্রতিষ্ঠানের নিজেস্ব ফান্ডে কম্পিউটার ল্যাব আছে ?') }}--}}
{{--                                <input name="own_lab" id="own_lab" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">--}}
{{--                                {{Form::hidden('hidden_own_lab',"No",["id"=>"hidden_own_lab"])}}--}}
{{--                            </div>--}}

{{--                            <div class="form-group  col-md-7">--}}
{{--                                {{ Form::label('total_pc_own', 'নিজেস্ব ফান্ডে ক্রয়কৃত সক্রিয় কম্পিউটারের সংখ্যা ') }}--}}
{{--                                {{ Form::selectRange('total_pc_own', 1, 200,['class'=>'form-control', 'id'=>'total_pc_own'] )}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-row">--}}
{{--                            <div class="form-group  col-md-5">--}}
{{--                                {{ Form::label('having_labs', 'ইতোপূর্বে সরকারি/বেসরকারি ভাবে ল্যাব প্রাপ্ত ?') }}--}}
{{--                                <input name="govlab" id="govlab" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">--}}
{{--                                {{Form::hidden('hidden_govlab',"No",["id"=>"hidden_govlab"])}}--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-7">--}}
{{--                                {{ Form::label('total_pc_gov_non_gov', 'সরকারি/বেসরকারি ভাবে প্রাপ্ত সক্রিয় কম্পিউটারের সংখ্যা') }}--}}
{{--                                {{ Form::selectRange('total_pc_gov_non_gov', 1, 200,['class'=>'form-control', 'id'=>'total_pc_gov_non_gov'] )}}--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-7">--}}
{{--                                {{ Form::label('labs', 'প্রাপ্ত ল্যাব সমূহ') }}--}}
{{--                                {{ Form::select('labs[]', $labs, null, ['class'=>'form-control', 'id' => 'labs_multiple', 'multiple' => 'multiple','disabled'=>true, 'data-placeholder'=>' একাধিক হতে পারে']) }}--}}
{{--                            </div>--}}

{{--                        </div>--}}


{{--                    </div>--}}

{{--                    <div class="fieldset-footer">--}}
{{--                        <span>Step 2 of 4</span>--}}
{{--                    </div>--}}
{{--                </fieldset>--}}


                <h3 class="step">
                    <span class="title_text">যন্ত্রপাতি/সরঞ্জাম ও অন্যান্য সুবিধা</span>
                </h3>

                <fieldset class="tab_2">
                    <div class="fieldset-content">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{ Form::label('having_labs', 'ইতোপূর্বে সরকারি ল্যাব প্রাপ্ত ?', array('class' => 'nothing')) }}
                                <input name="govlab" id="govlab" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_govlab',"NO",["id"=>"hidden_govlab"])}}
                            </div>

                            {{--                            <div class="form-group col-md-7">--}}
                            {{--                                {{ Form::label('total_pc_gov_non_gov', 'সরকারি/বেসরকারি ভাবে প্রাপ্ত সক্রিয় কম্পিউটারের সংখ্যা') }}--}}
                            {{--                                {{ Form::selectRange('total_pc_gov_non_gov', 1, 200,['class'=>'form-control', 'id'=>'total_pc_gov_non_gov'] )}}--}}
                            {{--                            </div>--}}

                            <div class="form-group col-md-6">
                                {{ Form::label('labs', 'প্রাপ্ত ল্যাব সমূহ', array('class' => 'nothing')) }}
{{--                                <span>প্রাপ্ত ল্যাব সমূহ</span>--}}
                                {{ Form::select('labs[]', $labs, null, ['class'=>'form-control', 'id' => 'labs_multiple', 'multiple' => 'multiple','disabled'=>true, 'data-placeholder'=>' একাধিক হতে পারে']) }}
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{ Form::label('proper_infrastructure', 'ল্যাব স্থাপনের জন্য উপযুক্ত অবকাঠামো আছে?') }}
                                <input name="proper_infrastructure" id="proper_infrastructure" type="checkbox" data-width="50"  class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_proper_infrastructure',"NO",["id"=>"hidden_proper_infrastructure"])}}
                            </div>
                            <div class="form-group  col-md-6">
                                {{ Form::label('proper_room', 'অন্তত ১৭টি টেবিল ও ৩২জন ছাত্রের বসার মত সুপরিসর কক্ষ আছে?') }}
                                <input name="proper_room" id="proper_room" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_proper_room',"NO",["id"=>"hidden_proper_room"])}}
                            </div>
                        </div>
                        <div class="form-row">
{{--                                {{ Form::label('boundary_wall', 'সীমানা প্রাচীর আছে?') }}--}}
{{--                                <input name="boundary_wall" id="boundary_wall" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">--}}
{{--                                {{Form::hidden('hidden_boundary_wall',"NO",["id"=>"hidden_boundary_wall"])}}--}}
{{--                                {{Form::hidden('hidden_',"NO",["id"=>""])}}--}}

                            <div class="form-group  col-md-6">
                                {{ Form::label('electricity_solar', 'নিরবিচ্ছিন্ন বিদ্যুৎ/সোলার সরবরাহ আছে ?') }}
                                <input name="electricity_solar" id="electricity_solar" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_electricity_solar',"NO",["id"=>"hidden_electricity_solar"])}}
                            </div>

{{--                            <div class="form-group  col-md-6">--}}
{{--                                {{ Form::label('cctv', 'সিসি ক্যামেরা আছে ?') }}--}}
{{--                                <input name="cctv" id="cctv" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">--}}
{{--                                {{Form::hidden('hidden_cctv',"NO",["id"=>"hidden_cctv"])}}--}}
{{--                            </div>--}}

                            <div class="form-group  col-md-6">
                                {{ Form::label('proper_security', 'ল্যাবের নিরাপত্তার জন্য উপযুক্ত পরিবেশ আছে?') }}
                                <input name="proper_security" id="proper_security" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_proper_security',"NO",["id"=>"hidden_proper_security"])}}
                            </div>

{{--                            <div class="form-group col-md-6">--}}
{{--                                {{ Form::label('night_guard', 'নৈশ প্রহরী আছে ?') }}--}}
{{--                                <input name="night_guard" id="night_guard" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">--}}
{{--                                {{Form::hidden('hidden_night_guard',"NO",["id"=>"hidden_night_guard"])}}--}}
{{--                            </div>--}}
                        </div>

                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{ Form::label('lab_maintenance', 'ল্যাবে সরবরাহকৃত আইটি ও অন্যান্য সরঞ্জামের রক্ষণাবেক্ষণ এবং ল্যাব পরিচালনা ও সংরক্ষণে প্রতিশ্ৰুতি সম্পন্ন শিক্ষা প্রতিষ্ঠান ?') }}
                                <input name="lab_maintenance" id="lab_maintenance" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_lab_maintenance',"NO",["id"=>"hidden_lab_maintenance"])}}
                            </div>
                            <div class="form-group  col-md-6" >
                                {{ Form::label('lab_prepared', 'ল্যাবের জন্য নির্ধারিত কক্ষটিতে যন্ত্রপাতি এবং আসবাবপত্র সরবরাহের পূর্বে ল্যাব কক্ষের সুরক্ষা ও নিরাপত্তা বৃদ্ধির জন্য উক্ত কক্ষের দরজা, জানালাসমূহ সুগঠিত রাখতে প্রস্তুত?') }}
                                <input name="lab_prepared" id="lab_prepared" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_lab_prepared',"NO",["id"=>"hidden_lab_prepared"])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6 ">
                                {{ Form::label('ict_edu', 'আইসিটি শিক্ষার সুযোগ সুবিধা আছে?') }}
                                <input name="ict_edu" id="ict_edu" type="checkbox"  data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_ict_edu',"NO",["id"=>"hidden_ict_edu"])}}
                            </div>

                        </div>
                        <div class="form-row sof">
                            <div class="form-group  col-md-6">
                                {{ Form::label('is_eiin', 'EIIN নম্বর আছে?') }}
                                <input name="is_eiin" id="is_eiin" type="checkbox"  data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_is_eiin',"NO",["id"=>"hidden_is_eiin"])}}
                            </div>
                            <div class="form-group col-md-6 is_mpo">
                                {{ Form::label('is_mpo', 'MPO ভুক্ত কিনা ?') }}
                                <input name="is_mpo" id="is_mpo" type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_is_mpo',"NO",["id"=>"hidden_is_mpo"])}}
                            </div>
                        </div>
                        <div class="form-row sof">
                            <div class="form-group  col-md-6">
                                {{ Form::label('has_ict_teacher', 'আইসিটি শিক্ষক আছে ?') }}
                                <input name="has_ict_teacher" id="has_ict_teacher" type="checkbox"  data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_has_ict_teacher',"NO",["id"=>"hidden_has_ict_teacher"])}}
                            </div>
                            <div class="form-group  col-md-6 " >
                                {{ Form::label('is_broadband', 'ব্রডব্যান্ড ইন্টারনেট সংযোগ আছে ?') }}
                                <input name="is_broadband" id="is_broadband" type="checkbox"  data-width="50" class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_is_broadband',"NO",["id"=>"hidden_is_broadband"])}}
                            </div>
                        </div>

                    </div>
                    <div class="fieldset-footer">
                        <span>Step 2 of 3</span>
                    </div>
                </fieldset>


                <h3 class="step">
                    <span class="title_text">বিবিধ </span>
                </h3>

                <fieldset class="tab_3">
                    <div class="fieldset-content">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {{ Form::label('reference', 'সুপারিশ আছে?') }}
                                <input name="reference" id="reference" type="checkbox" data-width="50" class="toggle form-control" data-width="100" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            </div>

                            {{--<div class="form-group col-md-6">--}}
                                {{--{{ Form::label('ref_type', 'সুপারিশকারীর পরিচয়') }}--}}
                                {{--{{ Form::select('ref_type',array('public_representative' => 'জন প্রতিনিধি', 'govt_emp' => 'সরকারি কর্মকর্তা',"famous_personel"=>"প্রখ্যাত ব্যক্তিত্ব","others"=>"অন্যান্য "), null,['class' => 'form-control',"disabled"=>"true"]) }}--}}
                            {{--</div>--}}
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {{ Form::label('ref_type', 'সুপারিশকারীর পরিচয়') }}
                                {{ Form::select('ref_type',array('public_representative' => 'মাননীয় সংসদ সদস্য', 'gov_emp' => 'সরকারি কর্মকর্তা',"famous_person"=>"প্রখ্যাত ব্যক্তিত্ব","others"=>"অন্যান্য "), null,['class' => 'form-control',"disabled"=>"true"]) }}
                            </div>

                            <div class="form-group  col-md-6">
                                {{ Form::label('ref_name', 'সুপারিশকারীর নাম') }}
                                {{ Form::text('ref_name',null,['class'=>'form-control','placeholder'=>'',"disabled"=>"true"]) }}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{ Form::label('ref_designation', 'সুপারিশকারীর পদবী') }}
                                {{ Form::text('ref_designation',null,['class' => 'form-control',"disabled"=>"true"])}}
                            </div>

                            <div class="form-group  col-md-6">
                                {{ Form::label('ref_office', 'সুপারিশকারীর কর্মস্থল') }}
                                {{ Form::text('ref_office',null,['class'=>'form-control','placeholder'=>'',"disabled"=>"true"]) }}
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="form-group col-md-2">
                                {{ Form::label('ref_documents', 'সুপারিশ সম্পর্কিত ডকুমেন্টস') }}
                            </div>

                            <div class="form-group col-md-10 ">
                                <div class="ref_documents_file">
                                    <input type="file" name="ref_documents_file" disabled class="custom-file-input" id="ref_documents_file">
                                    <label class="custom-file-label" for="ref_documents_file"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {{ Form::label('old_app', 'পূর্বে ডাক যোগে/সরাসরি আবেদন করেছেন?') }}
                                <input name="old_app" id="old_app" type="checkbox"  class="toggle form-control" data-width="50" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('old_application_date', 'আবেদনের তারিখ') }}
                                <div class="input-group date" id="old_application_date" data-target-input="nearest">
                                    <input type="text" width="100%" name="old_application_date" class="form-control datetimepicker-input" data-target="#old_application_date" disabled/>
                                    <div class="input-group-append" data-target="#old_application_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<div class="form-row ">--}}
                            {{--<div class="form-group ">--}}
                                {{--{{ Form::label('old_application_date', 'পূর্বে করা আবেদনের তারিখ') }}--}}
                                        {{--<!-- {{ Form::text('old_application_date', null, ['class' => 'form-control', 'id'=>'old_application_date',"disabled"=>"true"]) }} -->--}}
                                {{--<div class="input-group date" id="old_application_date" data-target-input="nearest">--}}
                                    {{--<input type="text" width="100%" name="old_application_date" class="form-control datetimepicker-input" data-target="#old_application_date" disabled/>--}}
                                    {{--<div class="input-group-append" data-target="#old_application_date" data-toggle="datetimepicker">--}}
                                        {{--<div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                {{ Form::label('old_application_attachment', 'পূর্বে করা আবেদনটি সংযুক্ত করুন') }}
                            </div>

                            <div class="form-group col-md-10">
                                <div class="old_application_attachment">
                                    <input type="file" name="old_application_attachment" disabled class="custom-file-input" id="old_application_attachment">
                                    <label class="custom-file-label" for="old_application_attachment"></label>
                                </div>
                            </div>
                        </div>

{{--                        <div class="form-row">--}}
{{--                            <div class="form-group col-md-2">--}}
{{--                                {{ Form::label('signature', 'আপনার স্বাক্ষর সংযুক্ত করুন') }}--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-10 ">--}}
{{--                                <div class="old_applicasition_attachment">--}}
{{--                                    <input type="file" name="signature"  class="custom-file-input" id="signature">--}}
{{--                                    <label class="custom-file-label" for="signature"></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="fieldset-footer">
                        <span>Step 3 of 3</span>
                    </div>
                </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

@section("js")
 <!-- JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('vendor/minimalist-picker/dobpicker.js')}}"></script>
    <script src="{{ asset('vendor/jquery.pwstrength/jquery.pwstrength.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/maximize-select2-height.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://kit.fontawesome.com/5b67dd8eb0.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#labs_multiple').select2().maximizeSelect2Height({
            //tags: true,
            //placeholder: "নির্বাচন করুন (একাধিক হতে পারে)"
            minimumResultsForSearch: -1,
            placeholder: function(){
                $(this).data('placeholder');
            },
            allowClear: true
           // data: ["Clare","Cork","South Dublin"],
            // tokenSeparators: [','],
            // placeholder: "Add your tags here",
            /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
            // selectOnClose: true,
            // closeOnSelect: false
        });

    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#submitbtn").click(function(e){
                //$("#myForm").submit(); // Submit the form
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Thank you! Your Application has been submitted!", {
                                icon: "success",
                            });
                            $("#signup-form").submit();
                        } else {
                            swal("Continue to fill out.......!");
                        }
                    });
            });
        });
    </script>
    {{--LAB TYPE SELECTION--}}
     <script type="text/javascript">
         $(function () {
             $("#lab_type").change(function () {

                 var res= {
                     "school": "স্কুল",
                     "college": "কলেজ",
                     "school and college": "স্কুল ও কলেজ",
                     "madrasha": "মাদ্রাসা",
                     "technical": "টেকনিক্যাল",
                     "primary": "প্রাইমারি",
                     "university": "বিশ্ববিদ্যালয়",
                     "gov_training": "সরকারি ট্রেনিং সেন্টার",
                     "gov_rel_ins": "শিক্ষা সংশ্লিষ্ট সরকারি প্রতিষ্ঠান",
                     "others": "অন্যান্য"
                 };
                 console.log($("#lab_type").val());
                 if ($(this).val() == "sof") {
                     $("#institution_type").empty();
                     $("#institution_type").append('<option value="school">স্কুল</option>');
                     $("#institution_type").append('<option value="school and college">স্কুল ও কলেজ</option>');
                     $(".sof").show();

                 } else {
                     $("#institution_type").empty();
                     $.each(res,function(key,value){
                         $("#institution_type").append('<option value="'+key+'">'+value+'</option>');
                     });
                     $(".sof").hide();
                 }
             });
         });
     </script>
     <script type="text/javascript">
         $(function () {
                 if ($("#lab_type").val() == "sof") {

                     $(".sof").show();

                 } else {

                     $(".sof").hide();
                 }
         });
         // $(function () {
         //     $("#lab_type").change(function () {
         //
         //         if ($(this).val() == "sof") {
         //
         //             $("#is_mpo").removeAttr("disabled");
         //             $("#is_mpo").show();
         //
         //         } else {
         //             $("#is_mpo").attr("disabled", "disabled");
         //             $("#is_mpo").hide();
         //         }
         //     });
         // });
     </script>
     <script type="text/javascript">

         $(function () {
             $("#institution_type").change(function () {

                 var ins_type= $("#institution_type option:selected" ).val();
                 if ($.inArray(ins_type, ["primary","university","gov_training","gov_rel_ins","others"]) >= 0) {
                     //alert($("#institution_type option:selected" ).val());
                     $("#eiin").attr("disabled", "disabled");

                 } else {
                     //alert('hi');
                     $("#eiin").removeAttr("disabled");

                 }
             });
         });
     </script>

     <script type="text/javascript">

         $(function () {
             $("#institution_type").change(function () {

                 var ins_type= $("#institution_type option:selected" ).val();
                 if ($.inArray(ins_type, ["primary","technical","university","gov_training","gov_rel_ins","others"]) >= 0) {
                     //alert($("#institution_type option:selected" ).val());
                     $("#mpo").attr("disabled", "disabled");
                 } else {
                     $("#mpo").removeAttr("disabled");
                 }
             });
         });
     </script>

    <script type="text/javascript">
        $(function () {
            $("#internet_connection").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#internet_connection_type").removeAttr("disabled");
                    $("#internet_connection_type").focus();
                } else {
                    $("#internet_connection_type").attr("disabled", "disabled");
                }
            });
        });
    </script>
     <script type="text/javascript">
         $(function () {
             $("#listed_by_deo").change(function () {

                 if ($(this).prop("checked") == true) {
                     $(".member_name").show();
                     $(".list_attachment").show();
                     $(".member_name").focus();
                     $(".step2").hide();
                     //$('.tab_2').hide();
                     //$('.tab_3').hide();
                     //$('.tab_4').hide();
                     //$('.title').hide();
                     $('.fieldset-footer').hide();
                     $('.actions').hide();
                     $('#submit').show();
                   //  $('.actions').html("<ul role=\"menu\" aria-label=\"Pagination\"><li aria-hidden=\"false\" style=\"\"><a  href=\"#finish\" role=\"menuitem\">Submit</a></li></ul>");
                   //   $('.actions').html("<ul role=\"menu\" aria-label=\"Pagination\"><li><button class=\"submitbtn btn btn-success\"  type=\"submit\">\n" +
                   //       "    Submit\n" +
                   //       "</button></li></ul>");
                 } else {
                     $(".member_name").hide();
                     $(".list_attachment").hide();
                     $(".step2").show();
                    // $('.tab_2').show();
                     //$('.tab_3').show();
                     //$('.tab_4').show();
                     //$('.title').show();
                     $('.fieldset-footer').show();
                     $('.actions').show();
                     $('#submit').hide();
                     //  $('.actions').html("<ul role=\"menu\" aria-label=\"Pagination\"><li aria-hidden=\"false\" style=\"\"><a  href=\"#finish\" role=\"menuitem\">Submit</a></li></ul>");
                     //$('.actions').html("");
                 }
             });
         });
     </script>
    <script type="text/javascript">
        $(function () {
            $("#reference").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#ref_type").removeAttr("disabled");
                    $("#ref_name").removeAttr("disabled");
                    $("#ref_designation").removeAttr("disabled");
                    $("#ref_office").removeAttr("disabled");
                    $("#ref_documents_file").removeAttr("disabled");
                    $("#refernce_type").focus();
                } else {
                    $("#ref_type").attr("disabled", "disabled");
                    $("#ref_name").attr("disabled", "disabled");
                    $("#ref_designation").attr("disabled", "disabled");
                    $("#ref_office").attr("disabled", "disabled");
                    $("#ref_documents_file").attr("disabled", "disabled");
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("#old_app").change(function () {

                if ($(this).prop("checked") == true) {
                    $(".datetimepicker-input").removeAttr("disabled");
                    $("#old_application_attachment").removeAttr("disabled");
                    $(".datetimepicker-input").focus();
                } else {
                    $(".datetimepicker-input").attr("disabled", "disabled");
                    $("#old_application_attachment").attr("disabled", "disabled");
                }
            });
        });
    </script>

     <script type="text/javascript">
         $(document).ready(function(){
             $("#total_pc_own").prop("disabled",true);
         });
         $(function () {
             $("#own_lab").change(function () {

                 if ($(this).prop("checked") == true) {
                     $("#total_pc_own").removeAttr("disabled");
                     $("#total_pc_own").focus();
                 } else {
                     $("#total_pc_own").attr("disabled", "disabled");
                 }
             });
         });
     </script>
     @if(!empty(old('govlab')))
         <script type="text/javascript">
             $(function () {
                 $('#govlab').bootstrapToggle('on');
                 $("#labs_multiple").removeAttr("disabled");
             });
         </script>
     @endif
     @if(!empty(old('listed_by_deo')))
         <script type="text/javascript">
             $(function () {
                 $('#listed_by_deo').bootstrapToggle('on');
                 //$("#labs_multiple").removeAttr("disabled");
             });
         </script>
     @endif
    <script type="text/javascript">
     $(document).ready(function(){
     $("#total_pc_gov_non_gov").prop("disabled",true);
     });
    $(function () {
        $("input[name='govlab']").change(function () {
            if ($(this).prop("checked") == true) {
                $("#labs_multiple").removeAttr("disabled");
                $("#total_pc_gov_non_gov").removeAttr("disabled");
                $("#labs_multiple").focus();
            } else {
                $("#labs_multiple").attr("disabled", "disabled");
                $("#total_pc_gov_non_gov").attr("disabled", "disabled")
            }
        });
    });
    </script>

    <script type="text/javascript">

     $(document).ready(function(){
         //$('#institution_type').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');

        //$('#total_pc_own').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#total_pc_gov_non_gov').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#internet_connection_type').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#ref_type').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
       // $('#div').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
       // $('#dis').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#upazila').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#union_pourashava_ward').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#management').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        //$('#student_type').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');

     });
    </script>

    <script type="text/javascript">
        $(function () {
            $('#old_application_date').datetimepicker({
                format: 'L',
                format: 'DD-MM-YYYY',
            });
        });
    </script>

    <script>
         $('.toggle').change(function(){

            var id = $(this).attr("id");
           // console.log(id);

           // $('#internet_connection').change(function () {
               // console.log('#hidden_'+id);
            if($(this).prop('checked'))
            {
                //console.log('#hidden_'+id);
            $('#hidden_'+id).val('YES');
            }
            else
            {
            $('#hidden_'+id).val('NO');
            }
           // });
        });
    </script>

@include('applications.applicationjs')
@endsection
