@extends('base')
@section('title', 'SRDL APPLICATION')

@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('main')
<div class="main">

<div class="container">
    <h2>অনলাইনে কম্পিউটার ল্যাবের জন্য আবেদন করুন  </h2>
    {{Form::open(array('route' => 'applications.store','method' => 'post','id'=>'signup-form','class'=>'signup-form','files' => true))}}
         @csrf
    <h3>
        <span class="title_text">শিক্ষা প্রতিষ্ঠানের বিবরণ</span>
    </h3>
    <fieldset>
        <div class="fieldset-content">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="">শিক্ষা প্রতিষ্ঠানের নাম</label>
                <input type="text" class="form-control" id="inputInsBn" name="institution_bn" placeholder="বাংলাতে">
                </div>
                <div class="form-group col-md-6">
                <label for="">শিক্ষা প্রতিষ্ঠানের নাম</label>
                <input type="text" class="form-control" id="inputInsEn" name="institution" placeholder="ইংরেজিতে">
                </div>
            </div>

            <div class="form-group">
                <label for="">প্রতিষ্ঠানের ধরন</label>
                {{Form::select('institution_type', array('primary'=>'প্রাইমারি','school' => 'স্কুল', 'college' => 'কলেজ', 'school and college'=> "স্কুল ও কলেজ", 'madrasha'=> "মাদ্রাসা",'technical'=>"টেকনিক্যাল",'gov_university'=>"সরকারি বিশ্ববিদ্যালয়",'others'=>"অন্যান্য"), 'স্কুল')}}
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="">প্রতিষ্ঠানের ইমেইল</label>
                <input type="text" class="form-control" id="institution_email" name="institution_email" placeholder="example@mail.com">
                </div>
                <div class="form-group col-md-6">
                <label for="">প্রতিষ্ঠানের টেলিফোন নম্বর</label>
                <input type="text" class="form-control" id="institution_tel" name="institution_tel" placeholder="">
                </div>
            </div>
            <div class="form-row">
                    <div class="form-group  col-md-4">
                        {{Form::label('div', 'বিভাগ') }}
                        {{ Form::select('division', $divisionList,'',array('class'=>'form-control','id'=>'div','style'=>'width:350px;')) }}

                    </div>
                    <div class="form-group  col-md-4">
                        {{Form::label('dis', 'জেলা') }}
                        {{Form::select('district', [], '',['id'=>'dis','class'=>'form-control','style'=>'width:350px;'])}}
{{--                        <select name="district" id="dis" class="form-control" style="width:350px">--}}
{{--                        </select>--}}
                    </div>
                    <div class="form-group  col-md-4">
                        {{Form::label('upazila', 'উপজেলা') }}
                        {{Form::select('upazila', [], '',['id'=>'upazila','class'=>'form-control','style'=>'width:350px;'])}}
                    </div>
            </div>

            <div class="form-row">
                <div class="form-group  col-md-4">
                    {{ Form::label('total_boys', 'মোট ছাত্র ') }}
                    {{ Form::selectRange('total_boys', 1, 2000,25,['id'=>'total_boys'] )}}
                </div>
                <div class="form-group  col-md-4">
                    {{ Form::label('total_girls', 'মোট ছাত্রী') }}
                    {{ Form::selectRange('total_girls', 1, 2000,30,['id'=>'total_girls'] )}}
                </div>
                <div class="form-group  col-md-4">
                    {{ Form::label('total_teachers', 'মোট শিক্ষক') }}
                    {{ Form::selectRange('total_teachers', 1, 100,30,['id'=>'total_teachers'] )}}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('is_mpo', 'MPO ভুক্ত কিনা ?') }}
                <label for="chkYes" class="radio-inline">
                    <input type="radio" id="chkYes" name="chkPassPort" />
                    হ্যাঁ
                </label>
                <label for="chkNo" class="radio-inline">
                    <input type="radio" id="chkNo" name="chkPassPort" />
                    না
                </label>
            </div>

            <div class="form-group">
                {{ Form::label('mpo', 'MPO কোড ') }}
                {{ Form::number('mpo',null,['id'=>"txtPassportNumber","disabled"=>"disabled"])}}
            </div>
        </div>
        <div class="fieldset-footer">
            <span>Step 1 of 4</span>
        </div>
    </fieldset>

    <h3>
        <span class="title_text">কম্পিউটার ল্যাব ও কম্পিউটারের সংখ্যা</span>
    </h3>
    <fieldset>

        <div class="fieldset-content">

            <div class="form-group">
            <span>প্রতিষ্ঠানের নিজেস্ব ফান্ডে কম্পিউটার ল্যাব আছে ?</span>
            <label class="radio-inline">
                <input type="radio" id="own_lab_yes" name="own_lab" value="Yes" />
                হ্যাঁ
                </label>
                <label class="radio-inline">
                <input type="radio" id="own_lab_no" name="own_lab" value="No" />
                না
                </label>
            </div>
            <div class="form-group">
            {{ Form::label('total_pc_own', 'নিজেস্ব ফান্ডে ক্রয়কৃত সক্রিয় কম্পিউটারের সংখ্যা ') }}
            {{ Form::selectRange('total_pc_own', 1, 200,['id'=>'total_pc_own'] )}}
            </div>
            <div class="form-group">
            <span>ইতোপূর্বে সরকারি/বেসরকারি ভাবে ল্যাব প্রাপ্ত ?</span>
            <label  class="radio-inline" for="labYes">
                <input type="radio" id="labYes" name="govlab" />
                হ্যাঁ
            </label>
            <label  class="radio-inline" for="labNo">
                <input type="radio" id="labNo" name="govlab" />
                না
            </label>
            </div>

            <div class="form-group">
            {{ Form::label('labs', 'প্রাপ্ত ল্যাব সমূহ') }}
            {{ Form::select('labs[]', $labs, null, ['id' => 'labs_multiple', 'multiple' => 'multiple','disabled'=>true, 'data-placeholder'=>' একাধিক হতে পারে']) }}
            </div>
            <div class="form-group">
                {{ Form::label('total_pc_gov_non_gov', 'সরকারি/বেসরকারি ভাবে প্রাপ্ত সক্রিয় কম্পিউটারের সংখ্যা') }}
                {{ Form::selectRange('total_pc_gov_non_gov', 1, 200,['id'=>'total_pc_gov_non_gov'] )}}
            </div>

            <div class="form-row">
                <div class="form-group  col-md-6">
                {{ Form::label('internet_connection', 'ইন্টারনেট সংযোগ আছে ?') }}
                <input name="internet_connection" id="internet_connection" type="checkbox"  class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                {{Form::hidden('hidden_internet_connection',"No",["id"=>"hidden_internet_connection"])}}
                </div>
                <div class="form-group  col-md-6">
                {{ Form::label('internet_connection_type', 'ইন্টারনেট সংযোগ এর ধরন ?') }}
                {{Form::select('internet_connection_type', array('modem' => 'মডেম', 'broadband' => 'ব্রডব্যান্ড'), null,['class' => 'form-control',"disabled"=>"true"])}}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                {{ Form::label('ict_teacher', 'আইসিটি শিক্ষক আছে ?') }}
                <input name="ict_teacher" id="ict_teacher" type="checkbox"  data-width="100" class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                {{Form::hidden('hidden_ict_teacher',"No",["id"=>"hidden_ict_teacher"])}}
                </div>
            </div>

        </div>
            <div class="fieldset-footer">
                     <span>Step 2 of 4</span>
            </div>

    </fieldset>


        <h3>
            <span class="title_text">যন্ত্রপাতি/সরঞ্জাম ও অন্যান্য সুবিধা</span>
        </h3>
        <fieldset>
            <div class="fieldset-content">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                     {{ Form::label('22_feet_by_18_feet', 'কম্পিউটার ল্যাব স্থাপনের জন্য ২২ফুট দৈর্ঘ্য ১৮ ফুট প্রস্থ বিশিষ্ট কক্ষ আছে ?') }}
                    <input name="22_feet_by_18_feet" id="22_feet_by_18_feet" type="checkbox" data-width="100" class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                    {{Form::hidden('hidden_22_feet_by_18_feet',"No",["id"=>"hidden_22_feet_by_18_feet"])}}
                    </div>
                    <div class="form-group  col-md-4">
                    {{ Form::label('packa_semi_packa', 'ভবনের ধরণ পাকা/অর্ধপাকা?') }}
                    <input name="packa_semi_packa" id="packa_semi_packa" type="checkbox"  class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                    {{Form::hidden('hidden_packa_semi_packa',"No",["id"=>"hidden_packa_semi_packa"])}}
                    </div>
                    <div class="form-group  col-md-4">
                    {{ Form::label('boundary_wall', 'সীমানা প্রাচীর আছে?') }}
                    <input name="boundary_wall" id="boundary_wall" type="checkbox"  class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                    {{Form::hidden('hidden_boundary_wall',"No",["id"=>"hidden_boundary_wall"])}}
                    {{Form::hidden('hidden_',"No",["id"=>""])}}
                    </div>
                </div>
                <div class="form-row">
                         <div class="form-group  col-md-3">
                        {{ Form::label('electricity_solar', 'বিদ্যুৎ/সোলার সংযোগ আছে ?') }}
                        <input name="electricity_solar" id="electricity_solar" type="checkbox" data-width="100" class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                         {{Form::hidden('hidden_electricity_solar',"No",["id"=>"hidden_electricity_solar"])}}
                        </div>
                        <div class="form-group  col-md-3">
                        {{ Form::label('cctv', 'সিসি ক্যামেরা আছে ?') }}
                        <input name="cctv" id="cctv" type="checkbox"  class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                         {{Form::hidden('hidden_cctv',"No",["id"=>"hidden_cctv"])}}
                        </div>
                        <div class="form-group  col-md-3">
                        {{ Form::label('security_guard', 'নিরাপত্তারক্ষী আছে ?') }}
                        <input name="security_guard" id="security_guard" type="checkbox"  class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                         {{Form::hidden('hidden_security_guard',"No",["id"=>"hidden_security_guard"])}}
                        </div>
                        <div class="form-group  col-md-3">
                        {{ Form::label('night_guard', 'নৈশ প্রহরী আছে ?') }}
                        <input name="night_guard" id="night_guard" type="checkbox"  class="toggle" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                         {{Form::hidden('hidden_night_guard',"No",["id"=>"hidden_night_guard"])}}
                        </div>
                </div>

                <div class="form-group shadow-textarea">
                <label for="about_institution">আপনার প্রতিষ্ঠান সম্পর্কে লিখুন </label>
                <textarea class="form-control z-depth-1" id="about_institution" rows="7" placeholder="আপনার প্রতিষ্ঠানের বিভিন্ন সুযোগ সুবিধা, কম্পিউটার ল্যাব কেন প্রয়োজন ইত্যাদি সম্পর্কে লিখুন..."></textarea>
                </div>

            </div>

            <div class="fieldset-footer">
                <span>Step 3 of 4</span>
            </div>
        </fieldset>

        <h3>
            <span class="title_text">বিবিধ </span>
        </h3>
        <fieldset>
            <div class="fieldset-content">
                <div class="form-row">
                    <div class="form-group">
                        {{ Form::label('reference', 'সুপারিশ আছে?') }}
                        <input name="reference" id="reference" type="checkbox"  class="toggle" data-width="100" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group  col-md-6">
                    {{ Form::label('ref_type', 'সুপারিশকারীর পরিচয়') }}
                    {{ Form::select('ref_type',array('public_representative' => 'জন প্রতিনিধি', 'govt_emp' => 'সরকারি কর্মকর্তা',"famous_personel"=>"প্রখ্যাত ব্যক্তিত্ব","others"=>"অন্যান্য "), null,['class' => 'form-control',"disabled"=>"true"]) }}
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
                    <div class="form-group">
                        {{ Form::label('old_app', 'পূর্বে ডাক যোগে/সরাসরি আবেদন করেছেন?') }}
                        <input name="old_app" id="old_app" type="checkbox"  class="toggle" data-width="100" data-toggle="toggle" data-on="হ্যাঁ" data-off="না" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group ">
                    {{ Form::label('old_application_date', 'পূর্বে করা আবেদনের তারিখ') }}
                    <!-- {{ Form::text('old_application_date', null, ['class' => 'form-control', 'id'=>'old_application_date',"disabled"=>"true"]) }} -->

                    <div class="input-group date" id="old_application_date" data-target-input="nearest">
                    <input type="text" width="100%" name="old_application_date" class="form-control datetimepicker-input" data-target="#old_application_date" disabled/>
                        <div class="input-group-append" data-target="#old_application_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                    {{ Form::label('old_application_attachment', 'পূর্বে করা আবেদনটি সংযুক্ত করুন') }}
                    </div>
                    <div class="form-group col-md-10 ">
                        <div class="old_application_attachment">
                            <input type="file" name="old_application_attachment" disabled class="custom-file-input" id="old_application_attachment">
                            <label class="custom-file-label" for="old_application_attachment"></label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                    {{ Form::label('signature', 'আপনার স্বাক্ষর সংযুক্ত করুন') }}
                    </div>
                    <div class="form-group col-md-10 ">
                        <div class="old_applicasition_attachment">
                            <input type="file" name="signature"  class="custom-file-input" id="signature">
                            <label class="custom-file-label" for="signature"></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fieldset-footer">
                <span>Step 4 of 4</span>
            </div>
        </fieldset>
        {{ Form::close() }}
</div>

</div>
@endsection

@section("js")
 <!-- JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
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
    $(function () {
        $("input[name='chkPassPort']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#txtPassportNumber").removeAttr("disabled");
                $("#txtPassportNumber").focus();
            } else {
                $("#txtPassportNumber").attr("disabled", "disabled");
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
        $("input[name='own_lab']").click(function () {
            if ($("#own_lab_yes").is(":checked")) {
                $("#total_pc_own").removeAttr("disabled");
                $("#total_pc_own").focus();
            } else {
                $("#total_pc_own").attr("disabled", "disabled");
            }
        });
    });
    </script>

    <script type="text/javascript">
     $(document).ready(function(){
    $("#total_pc_gov_non_gov").prop("disabled",true);
     });
    $(function () {
        $("input[name='govlab']").click(function () {
            if ($("#labYes").is(":checked")) {
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
        $('#total_boys').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#total_girls').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#total_teachers').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#total_pc_own').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#total_pc_gov_non_gov').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#internet_connection_type').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#ref_type').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#div').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#dis').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');
        $('#upazila').prepend('<option value="-1" selected="selected" disabled>নির্বাচন করুন </option>');

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
            $('#hidden_'+id).val('Yes');
            }
            else
            {
            $('#hidden_'+id).val('No');
            }
           // });
        });
    </script>

@include('applications.applicationjs')
@endsection
