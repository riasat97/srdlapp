@extends('layouts.app')
@section('css')

    <link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
{{--    <link rel="stylesheet" href="{{ asset('css/support.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/labEdit.css') }}">
@endsection
@section('content')
    <section class="content-header text-center">
        <h2 class="institution">{{ $lab->ins.', '.$lab->upazila.', '.$lab->district }}</h2>
        <h1>
            চার (০৪) জন প্রশিক্ষণার্থীদের তালিকা
        </h1>
   </section>
   <div class="content">
       @include('flash::message')

       <div class="clearfix">
       </div>
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <p><span style="color:red">*</span> সব তথ্য পূরণ করতে হবে</p>
               <p><span style="color:red">*</span>
                   <a href="#" class="alert-danger">
                       প্রশিক্ষণার্থীদের তথ্য পূরণ করতে গিয়ে কোনো সমস্যার সম্মুখীন হলে (01672702437) এই নম্বরে
                       whatsapp (শুধুমাত্র মেসেজ) করার জন্য অনুরোধ করা হলো।
                   </a>
               </p>
                   {!! Form::open(['route' => ['labs.trainees.update', $lab->id], 'method' => 'patch']) !!}

                        @include('trainees.fields')

                   {!! Form::close() !!}

           </div>
       </div>
   </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $('.date').datetimepicker({
                format: "YYYY-MM-DD",
                minDate: subtractYears(new Date(), 59),
                maxDate: subtractYears(new Date(), 21),
                useCurrent: false
            });
        });
        function subtractYears(date, years) {
            date.setFullYear(date.getFullYear() - years);
            return date;
        }
        $(function () {
            // $('select.form-control option:first').attr('disabled', true);
            $('select.form-control option:contains("নির্বাচন করুন")').attr("disabled","disabled");
        });
        $('.toggle').change(function(){

            var id = $(this).attr("id");
            // console.log(id);
            // $('#internet_connection').change(function () {
            // console.log('#hidden_'+id);
            if($(this).prop('checked'))
            {
                //console.log('#hidden_'+id);
                $('#hidden_'+id).val('yes');
            }
            else
            {
                $('#hidden_'+id).val('no');
            }
            // });
        });

        @if(!empty(old('training.0')))
        $(function () {
            $('#ict_training1').bootstrapToggle('on');
            $("#ict_training1_title_label").prop('disabled', false).show();
            $("#ict_training1_title").focus();
            $("#ict_training1_title").prop('required',true);
            $("#ict_training1_title").prop('disabled',false);
            $("#ict_training1_duration").prop('required',true);
            $("#ict_training1_duration").prop('disabled',false);
            $("#ict_training1_duration_label").show();
        });
        @endif
        @if(empty(old('training.0')))
        @if(!empty($lab->trainees[0]->training_title))

        $(function () {
            $("#ict_training1_title_label").show();
            $("#ict_training1_title").focus();
            $("#ict_training1_title").prop('required',true);
            $("#ict_training1_title").prop('disabled',false);
            $("#ict_training1_duration").prop('required',true);
            $("#ict_training1_duration").prop('disabled',false);
            $("#ict_training1_duration_label").show();
            //$("#labs_multiple").removeAttr("disabled");
        });
        @else
            $(function () {
            $("#ict_training1_title_label").hide();
            $("#ict_training1_duration_label").hide();
            $("#ict_training1_title").prop('required',false);
            $("#ict_training1_title").val('');
            $("#ict_training1_duration").prop('required',false);
            $("#ict_training1_duration").val('');
            });
        @endif
        @endif
        $(function () {
            $("#ict_training1").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#ict_training1_title_label").show();
                    $("#ict_training1_title").focus();
                    $("#ict_training1_title").prop('required',true);
                    $("#ict_training1_title").prop('disabled',false);
                    $("#ict_training1_duration").prop('required',true);
                    $("#ict_training1_duration").prop('disabled',false);
                    $("#ict_training1_duration_label").show();
                }
                else{
                    $("#ict_training1_title_label").hide();
                    $("#ict_training1_duration_label").hide();
                    $("#ict_training1_title").prop('required',false);
                    $("#ict_training1_title").val('');
                    $("#ict_training1_duration").prop('required',false);
                    $("#ict_training1_duration").val('');
                }
            });
        });
        // 2ND

        @if(!empty(old('training.1')))
        $(function () {
            $('#ict_training2').bootstrapToggle('on');
            $("#ict_training2_title_label").show();
            $("#ict_training2_title").focus();
            $("#ict_training2_title").prop('required',true);
            $("#ict_training2_title").prop('disabled',false);
            $("#ict_training2_duration").prop('required',true);
            $("#ict_training2_duration").prop('disabled',false);
            $("#ict_training2_duration_label").show();
        });
        @endif
        @if(empty(old('training.1')))
        @if(!empty($lab->trainees[1]->training_title))
        $(function () {
            $("#ict_training2_title_label").show();
            $("#ict_training2_title").focus();
            $("#ict_training2_title").prop('required',true);
            $("#ict_training2_title").prop('disabled',false);
            $("#ict_training2_duration").prop('required',true);
            $("#ict_training2_duration").prop('disabled',false);
            $("#ict_training2_duration_label").show();
            //$("#labs_multiple").removeAttr("disabled");
        });
        @else
        $(function () {
            $("#ict_training2_title_label").hide();
            $("#ict_training2_duration_label").hide();
            $("#ict_training2_title").prop('required',false);
            $("#ict_training2_title").val('');
            $("#ict_training2_duration").prop('required',false);
            $("#ict_training2_duration").val('');
        });
        @endif
        @endif
        $(function () {
            $("#ict_training2").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#ict_training2_title_label").show();
                    $("#ict_training2_title").focus();
                    $("#ict_training2_title").prop('required',true);
                    $("#ict_training2_title").prop('disabled',false);
                    $("#ict_training2_duration").prop('required',true);
                    $("#ict_training2_duration").prop('disabled',false);
                    $("#ict_training2_duration_label").show();
                }
                else{
                    $("#ict_training2_title_label").hide();
                    $("#ict_training2_duration_label").hide();
                    $("#ict_training2_title").prop('required',false);
                    $("#ict_training2_title").val('');
                    $("#ict_training2_duration").prop('required',false);
                    $("#ict_training2_duration").val('');
                }
            });
        });
        // 3RD

        @if(!empty(old('training.2')))
        $(function () {
            $('#ict_training3').bootstrapToggle('on');
            $("#ict_training3_title_label").show();
            $("#ict_training3_title").focus();
            $("#ict_training3_title").prop('required',true);
            $("#ict_training3_title").prop('disabled',false);
            $("#ict_training3_duration").prop('required',true);
            $("#ict_training3_duration").prop('disabled',false);
            $("#ict_training3_duration_label").show();
        });
        @endif
        @if(empty(old('training.2')))
        @if(!empty($lab->trainees[2]->training_title))
        $(function () {
            $("#ict_training3_title_label").show();
            $("#ict_training3_title").focus();
            $("#ict_training3_title").prop('required',true);
            $("#ict_training3_title").prop('disabled',false);
            $("#ict_training3_duration").prop('required',true);
            $("#ict_training3_duration").prop('disabled',false);
            $("#ict_training3_duration_label").show();
            //$("#labs_multiple").removeAttr("disabled");
        });
        @else
        $(function () {
            $("#ict_training3_title_label").hide();
            $("#ict_training3_duration_label").hide();
            $("#ict_training3_title").prop('required',false);
            $("#ict_training3_title").val('');
            $("#ict_training3_duration").prop('required',false);
            $("#ict_training3_duration").val('');
        });
        @endif
        @endif
        $(function () {
            $("#ict_training3").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#ict_training3_title_label").show();
                    $("#ict_training3_title").focus();
                    $("#ict_training3_title").prop('required',true);
                    $("#ict_training3_title").prop('disabled',false);
                    $("#ict_training3_duration").prop('required',true);
                    $("#ict_training3_duration").prop('disabled',false);
                    $("#ict_training3_duration_label").show();
                }
                else{
                    $("#ict_training3_title_label").hide();
                    $("#ict_training3_duration_label").hide();
                    $("#ict_training3_title").prop('required',false);
                    $("#ict_training3_title").val('');
                    $("#ict_training3_duration").prop('required',false);
                    $("#ict_training3_duration").val('');
                }
            });
        });
        // 4TH

        @if(!empty(old('training.3')))
        $(function () {
            $('#ict_training4').bootstrapToggle('on');
            $("#ict_training4_title_label").show();
            $("#ict_training4_title").focus();
            $("#ict_training4_title").prop('required',true);
            $("#ict_training4_title").prop('disabled',false);
            $("#ict_training4_duration").prop('required',true);
            $("#ict_training4_duration").prop('disabled',false);
            $("#ict_training4_duration_label").show();
        });
        @endif
        @if(empty(old('training.3')))
        @if(!empty($lab->trainees[3]->training_title))
        $(function () {
            $("#ict_training4_title_label").show();
            $("#ict_training4_title").focus();
            $("#ict_training4_title").prop('required',true);
            $("#ict_training4_title").prop('disabled',false);
            $("#ict_training4_duration").prop('required',true);
            $("#ict_training4_duration").prop('disabled',false);
            $("#ict_training4_duration_label").show();
            //$("#labs_multiple").removeAttr("disabled");
        });
        @else
        $(function () {
            $("#ict_training4_title_label").hide();
            $("#ict_training4_duration_label").hide();
            $("#ict_training4_title").prop('required',false);
            $("#ict_training4_title").val('');
            $("#ict_training4_duration").prop('required',false);
            $("#ict_training4_duration").val('');
        });
        @endif
        @endif
        $(function () {
            $("#ict_training4").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#ict_training4_title_label").show();
                    $("#ict_training4_title").focus();
                    $("#ict_training4_title").prop('required',true);
                    $("#ict_training4_title").prop('disabled',false);
                    $("#ict_training4_duration").prop('required',true);
                    $("#ict_training4_duration").prop('disabled',false);
                    $("#ict_training4_duration_label").show();
                }
                else{
                    $("#ict_training4_title_label").hide();
                    $("#ict_training4_duration_label").hide();
                    $("#ict_training4_title").prop('required',false);
                    $("#ict_training4_title").val('');
                    $("#ict_training4_duration").prop('required',false);
                    $("#ict_training4_duration").val('');
                }
            });
        });
    </script>
@endpush
