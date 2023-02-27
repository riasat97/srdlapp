@extends('layouts.app')
@section('title', 'SRDL APPLICATION')

@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/zInput_default_stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/labEdit.css') }}">
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />--}}
@endsection

@section('content')

    <div class="main">
        <div class="container main-container">

{{--            <div class="col-md-12 top-heading">--}}
{{--                <h2>প্রাথমিকভাবে শেখ রাসেল ডিজিটাল ল্যাব/ স্কুল অফ ফিউচারের উপযুক্ততা যাচাইয়ের জন্য শিক্ষা প্রতিষ্ঠান নির্বাচন সংশ্লিষ্ট প্রতিবেদন</h2>--}}
{{--            </div>--}}
            <div class="page-header text-center">
                <h1>{{ $lab->ins?? old('institution_corrected') }}
                    <small>{{$lab->lab_type}}</small></h1>
            </div>
            @include('flash::message')
            <div class="clearfix">
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
                {{Form::open(array('route' => ['web.labs.update', $lab->id],'method' => 'patch','id'=>'labUpdate-form','class'=>'labUpdate-form','files' => true))}}
                @csrf
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">শিক্ষা প্রতিষ্ঠানের বিবরণ</h3>
                    </div>
                    <div class="panel-body">
                        {{Form::hidden('lab_id',$lab->id)}}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lab_type">কম্পিউটার ল্যাবের ধরণ</label>
                                {{Form::select('lab_type', array('0' => 'নির্বাচন করুন','srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার','srdl_sof' => 'স্কুল অফ ফিউচার ও শেখ রাসেল ডিজিটাল ল্যাব'), $lab->lab_type,['class'=>'form-control', 'id'=>'lab_type',])}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phase">পর্যায়</label>
                                {{ Form::select('phase',$phase,$lab->phase,array('class'=>'form-control','id'=>'phase')) }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label class="" for="">শিক্ষা প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control" id="inputInsBn" name="institution"
                                       value="{{ $lab->institution }}" placeholder="বাংলাতে">
                            </div>
                            <div class="form-group col-md-5 only-label" style="">
                                {{ Form::label('is_institution_bn_correction_needed', 'প্রতিষ্ঠানটির নামটির সংশোধন প্রয়োজন?') }}
                                <input name="is_institution_bn_correction_needed"
                                       @if(!empty($lab->institution_corrected) )checked
                                       @endif id="is_institution_bn_correction_needed" type="checkbox" data-width="50"
                                       class="toggle form-control" data-toggle="toggle" data-on="হ্যাঁ" data-off="না"
                                       data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_is_institution_bn_correction_needed',"No",["id"=>"hidden_is_institution_bn_correction_needed"])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 institution_corrected">
                                <label for="">সংশোধনকৃত প্রতিষ্ঠানটির নাম </label>
                                <input type="text" class="form-control" id="institution_corrected"
                                       name="institution_corrected"
                                       value="{{ $lab->institution_corrected?? old('institution_corrected') }}"
                                       placeholder="বাংলাতে">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">শিক্ষা প্রতিষ্ঠানের নাম (ENGLISH)</label>
                                {{--<input type="text" class="form-control" id="inputInsEn" name="institution" value="{{ $lab->institution ?? old('institution') }}" placeholder="ইংরেজিতে">--}}
                                {{ Form::text('institution_en',$lab->institution_en??'',['class'=>'form-control','id'=>'inputInsEn','placeholder'=>'ইংরেজিতে']) }}
                            </div>
                           {{-- <div class="form-group col-md-4">
                                <label for="">ম্যানেজমেন্ট</label>
                                {{Form::select('management', array_merge(['0' => 'নির্বাচন করুন'],management()), $lab->management ?? 0,['class'=>'form-control', 'id'=>'management'])}}
                            </div>--}}
                        </div>
                        <div class="form-row">
                            @if($lab->lab_type== "srdl")

                                <div class="form-group col-md-4">
                                    <label for="">প্রতিষ্ঠানের ধরন</label>
                                    {{Form::select('institution_type',$ins_type, getResult(ins_type(),$lab->institution_type),['class'=>'form-control', 'id'=>'institution_type',])}}
                                </div>
                                @if($lab->institution_type=="টেকনিক্যাল")
                                    <div class="form-group col-md-4">
                                        <label for="">প্রতিষ্ঠানের স্তর</label>
                                        {{Form::select('institution_level',$ins_level_technical, getResult(ins_level(),$lab->institution_level),['class'=>'form-control', 'id'=>'institution_level',])}}
                                    </div>
                                @else
                                    <div class="form-group col-md-4">
                                        <label for="">প্রতিষ্ঠানের স্তর</label>
                                        {{Form::select('institution_level',$ins_level, getResult(ins_level(),$lab->institution_level),['class'=>'form-control', 'id'=>'institution_level',])}}
                                    </div>
                                @endif

                            @else
                                <div class="form-group col-md-4">
                                    <label for="">প্রতিষ্ঠানের ধরন</label>
                                    {{Form::select('institution_type',$ins_type_sof, getResult(ins_type(),$lab->institution_type),['class'=>'form-control', 'id'=>'institution_type',])}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">প্রতিষ্ঠানের স্তর</label>
                                    {{Form::select('institution_level',$ins_level_sof, getResult(ins_level(),$lab->institution_level),['class'=>'form-control', 'id'=>'institution_level',])}}
                                </div>
                            @endif
                            <div class="form-group col-md-4">
                                <label for="">EIIN নম্বর</label>
                                {{ Form::number('eiin', $lab->eiin ?? "",['class'=>'form-control', 'id'=>"eiin"])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                {{ Form::label('total_tecahers', 'মোট শিক্ষক/শিক্ষিকা') }}
                                {{ Form::number('total_teachers', $lab->total_teachers ?? '',['class'=>'form-control', 'id'=>'total_girls'] )}}
                            </div>

                            <div class="form-group  col-md-4">
                                {{ Form::label('total_boys', 'মোট ছাত্র ') }}
                                {{--                                {{ Form::selectRange('total_boys', 1, 5000,25,['class'=>'form-control', 'id'=>'total_boys'] )}}--}}
                                {{ Form::number('total_boys', $lab->total_boys ?? '' ,['class'=>'form-control', 'id'=>'total_boys'] )}}
                            </div>
                            <div class="form-group  col-md-4">
                                {{ Form::label('total_girls', 'মোট ছাত্রী') }}
                                {{--                                {{ Form::selectRange('total_girls', 1, 5000,30,['class'=>'form-control', 'id'=>'total_girls'] )}}--}}
                                {{ Form::number('total_girls', $lab->total_girls ?? '',['class'=>'form-control', 'id'=>'total_girls'] )}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">প্রতিষ্ঠান প্রধানের নাম</label>
                                {{Form::text('head_name',$lab->head_name ?? '' ,['id'=>'head_name','class'=>'form-control','style'=>'','placeholder'=>"বাংলাতে"])}}
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">প্রতিষ্ঠানের ইমেইল</label>
                                {{Form::email('institution_email',$lab->institution_email ?? '' ,['id'=>'institution_email','class'=>'form-control','style'=>'','placeholder'=>"example@mail.com"])}}
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">প্রতিষ্ঠানের মোবাইল নম্বর</label>
                                {{Form::tel('institution_tel',$lab->institution_tel ?? '' ,['id'=>'institution_tel','class'=>'form-control','style'=>'','placeholder'=>"01xxxxxxxxx",'pattern'=>"[0-9]{11}"])}}
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">বিকল্প মোবাইল নম্বর</label>
                                {{Form::tel('alt_tel',$lab->alt_tel ?? '' ,['id'=>'alt_tel','class'=>'form-control','style'=>'','placeholder'=>"01xxxxxxxxx",'pattern'=>"[0-9]{11}"])}}
                            </div>
                        </div>
                    </div>
                </div>

                {{--প্রতিষ্ঠানের ঠিকানা--}}

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">শিক্ষা প্রতিষ্ঠানের ঠিকানা</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{Form::label('div', 'বিভাগ') }}
                                {{ Form::select('division', $divisionList,$lab->division,array('class'=>'form-control','id'=>'div','style'=>'')) }}
                            </div>
                            <div class="form-group  col-md-6">
                                {{Form::label('dis', 'জেলা') }}
                                {{Form::select('district', $districtList, $lab->district,['id'=>'dis','class'=>'form-control','style'=>''])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                {{Form::label('upazila', 'উপজেলা') }}
                                {{Form::select('upazila',$upazilaList, $lab->upazila,['id'=>'upazila','class'=>'form-control','style'=>''])}}
                            </div>
                            <div class="form-group  col-md-4" >
                                {{Form::label('union_pourashava_ward', 'ইউনিয়ন/পৌরসভা/ওয়ার্ড ') }}
                                {{Form::select('union_pourashava_ward',$unionPourashavaWardList, $lab->union_pourashava_ward,['id'=>'union_pourashava_ward','class'=>'form-control','style'=>''])}}
                            </div>
                            <div class="form-group  col-md-6" id="union_others_label">
                                {{Form::label('union_pourashava_ward', 'অন্যান্য ইউনিয়ন/পৌরসভা/ওয়ার্ড ') }}
                                {{Form::text('union_others',$lab->union_others??"",['id'=>'union_others','class'=>'form-control','style'=>''])}}
                            </div>
                            <div class="form-group  col-md-4">
                                {{Form::label('ward', 'ওয়ার্ড নং') }}
                                {{Form::number('ward',$lab->ward??"",['id'=>'ward','class'=>'form-control','style'=>''])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-3">
                                {{Form::label('seat_type', 'সংসদীয় আসনের ধরণ') }}
                                {{Form::select('seat_type', ['general'=>'সাধারণ', 'reserved'=>'সংরক্ষিত মহিলা আসন'], $lab->seat_type,['id'=>'seat_type','class'=>'form-control'])}}
                            </div>
                            <div class="form-group  col-md-3 only-label">
                                {{Form::label('seat_no', 'সংসদীয় আসন নং:'.$lab->seat_no,array('id' => 'seat-no')) }}
                                {{--                                {{Form::hidden('seat_no',old('seat_no'),["id"=>"hidden_seat_no"])}}--}}
                                <input type="hidden" name="seat_no" value="{{ $lab->seat_no }}"
                                       id="hidden_seat_no">
                            </div>

                            <div class="form-group  col-md-3">
                                {{Form::label('parliamentary_constituency', 'নির্বাচনী এলাকার নাম') }}
                                {{Form::select('parliamentary_constituency', [$lab->parliamentary_constituency => $lab->parliamentary_constituency ], $lab->parliamentary_constituency ,['id'=>'parliamentary_constituency','class'=>'form-control','style'=>''])}}
                            </div>
                            <div class="form-group col-md-3 only-label" id="hidethis" style="display: none">
                                {{ Form::label('is_parliamentary_constituency_ok', 'নির্বাচনী এলাকাটি সঠিক?') }}
                                <input name="is_parliamentary_constituency_ok" id="is_parliamentary_constituency_ok"
                                       type="checkbox" data-width="50" class="toggle form-control" data-toggle="toggle"
                                       data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                                {{Form::hidden('hidden_is_parliamentary_constituency_ok',"No",["id"=>"hidden_is_parliamentary_constituency_ok"])}}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                {{Form::label('latitude', 'অক্ষাংশ (LATITUDE)') }}
                                {{Form::number('latitude',  $lab->latitude??"",['id'=>'latitude','class'=>'form-control','style'=>'','placeholder'=>'23.694312'])}}
                            </div>
                            <div class="form-group  col-md-6">
                                {{Form::label('longitude', 'দ্রাঘিমাংশ (LONGITUDE)') }}
                                {{Form::number('longitude',$lab->longitude??"",['id'=>'longitude','class'=>'form-control','style'=>'','placeholder'=>'90.344352'])}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12" style="" id="">
                        <button class="btn btn-primary" id="submitbtn" type="submit">সংরক্ষণ</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
{{--    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>--}}
    <!-- JS -->
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('vendor/minimalist-picker/dobpicker.js')}}"></script>
    <script src="{{ asset('vendor/jquery.pwstrength/jquery.pwstrength.js')}}"></script>
{{--    <script src="{{ asset('js/main.js')}}"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>--}}
    <script src="{{ asset('js/maximize-select2-height.min.js')}}"></script>
    <script src="{{ asset('js/zInput.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://kit.fontawesome.com/5b67dd8eb0.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if(!empty($lab->institution_corrected))
        <script type="text/javascript">
            $(function () {
                $(".institution_corrected").show();
                $(".institution_corrected").focus();
                //$("#labs_multiple").removeAttr("disabled");
            });
        </script>
    @else
        <script type="text/javascript">
            $(function () {
                $(".institution_corrected").hide();
            });
        </script>
    @endif

    <script type="text/javascript">
        $(function () {
            $("#is_institution_bn_correction_needed").change(function () {

                if ($(this).prop("checked") == true) {
                    $(".institution_corrected").show();
                }
                else{
                    $(".institution_corrected").hide();
                }
            });
        });
    </script>
    @if(!empty($lab->union_others))
        <script type="text/javascript">
            $(function () {
                $('#union_others_label').show();
            });
        </script>
    @else
        <script type="text/javascript">
            $(function () {
                $('#union_others_label').hide();
            });
        </script>
    @endif


    <script type="text/javascript">

        $(document).ready(function(){
            $("#submitbtn").click(function(e){
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                    .then((update) => {
                        if (update) {
                            swal("Thank you! Given Information has been updated!", {
                                icon: "success",
                            });
                            $("#labUpdate-form").submit();
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
                var ins_type = @json($ins_type);
                var ins_type_sof = @json($ins_type_sof);
                var ins_type_selected= "{{$lab->institution_type}}";
                console.log(ins_type_selected);
                console.log($("#lab_type").val());
                if ($(this).val() == "sof") {
                    $("#institution_type").empty();
                    $.each(ins_type_sof,function(key,value){
                        $("#institution_type").append('<option value="'+key+'">'+value+'</option>');
                    });
                    $("#institution_type option:contains('" + ins_type_selected+ "')").prop('selected',true);
                    $(".verify").show();
                    $("#upazila_verified_lb").text('সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে স্কুল অফ ফিউচার স্থাপনের জন্য:');
                    $("#district_verified_lb").text('জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে স্কুল অফ ফিউচার:');
                    $(".sof").show();

                } else {
                    $("#institution_type").empty();
                    $.each(ins_type,function(key,value){
                        $("#institution_type").append('<option value="'+key+'">'+value+'</option>');
                    });
                    $("#institution_type option:contains('" + ins_type_selected+ "')").prop('selected',true);
                    $(".verify").show();
                    $("#upazila_verified_lb").text('সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে শেখ রাসেল ডিজিটাল ল্যাব স্থাপনের জন্য:');
                    $("#district_verified_lb").text('জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে শেখ রাসেল ডিজিটাল ল্যাব:');
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

    </script>

    <script type="text/javascript">

        $(function () {
            $("#institution_type").change(function () {
                var lab_type= $("#lab_type").val();
                var ins_type= $("#institution_type option:selected" ).val();

                var ins_level = @json($ins_level);
                var ins_level_technical = @json($ins_level_technical);
                var ins_level_sof = @json($ins_level_sof);

                var ins_level_selected= "{{$lab->institution_level}}";

                //console.log($("#lab_type").val());
                if ($.inArray(ins_type, ["general","madrasha"]) >= 0 && lab_type=="srdl") {
                    $("#institution_level").removeAttr("disabled");
                    $("#institution_level").empty();
                    $.each(ins_level,function(key,value){
                        $("#institution_level").append('<option value="'+key+'">'+value+'</option>');
                    });
                    //$("#institution_level option:contains('" + ins_level_selected+ "')").prop('selected',true);
                    var text1 = ins_level_selected;
                    $("select option").filter(function() {
                        //may want to use $.trim in here
                        return $(this).text() == text1;
                    }).prop('selected', true);
                }
                else if(ins_type=="technical" && lab_type=="srdl"){
                    $("#institution_level").removeAttr("disabled");
                    $("#institution_level").empty();
                    $.each(ins_level_technical,function(key,value){
                        $("#institution_level").append('<option value="'+key+'">'+value+'</option>');
                    });
                    //$("#institution_level option:contains('" + ins_level_selected+ "')").prop('selected',true);
                    var text1 = ins_level_selected;
                    $("select option").filter(function() {
                        //may want to use $.trim in here
                        return $(this).text() == text1;
                    }).prop('selected', true);
                }
                else if($.inArray(ins_type, ["general","madrasha","technical"]) >= 0 && lab_type=="sof"){
                    $("#institution_level").removeAttr("disabled");
                    $("#institution_level").empty();
                    $.each(ins_level_sof,function(key,value){
                        $("#institution_level").append('<option value="'+key+'">'+value+'</option>');
                    });
                    //$("#institution_level option:contains("+ ins_level_selected+")").prop('selected',true);
                    var text1 = ins_level_selected;
                    $("select option").filter(function() {
                        //may want to use $.trim in here
                        return $(this).text() == text1;
                    }).prop('selected', true);
                }
                else {
                    $("#institution_level").empty();
                    $("#institution_level").attr("disabled", "disabled");
                }
            });
        });
    </script>

    {{--make mpo and eiin disabled--}}
    <script type="text/javascript">

        $(function () {
            $("#institution_type").change(function () {

                var ins_type= $("#institution_type option:selected" ).val();
                if ($.inArray(ins_type, ["gov_training","gov_rel_ins","others"]) >= 0) {
                    //alert($("#institution_type option:selected" ).val());
                    $("#eiin").attr("disabled", "disabled");
                    $("#mpo").attr("disabled", "disabled");
                } else {
                    //alert('hi');
                    $("#eiin").removeAttr("disabled");
                    $("#mpo").removeAttr("disabled");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $("select option:first-child").attr("disabled", "true");
            $("select#seat_type option:first").attr("disabled", false);
            $("select#parliamentary_constituency option:first").attr("disabled", false);
        });

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
    @if(Auth::user()->hasRole(['upazila admin','district admin']))
        <script type="text/javascript">
            $(function () {
                $("#lab_type").attr("disabled", "disabled");
                $("#inputInsBn").attr("disabled", "disabled");
                $("#div").attr("disabled", "disabled");
                $("#dis").attr("disabled", "disabled");
                $("#upazila").attr("disabled", "disabled");
                $("#seat_type").attr("disabled", "disabled");
                $("#phase").attr("disabled", "disabled");
            });
        </script>
    @endif
    @include('applications.applicationjs')
    @include('applications.application-edit-reloadjs')
@endpush
