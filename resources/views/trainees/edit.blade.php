@extends('layouts.app')
@section('css')
    <link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
{{--    <link rel="stylesheet" href="{{ asset('css/support.css') }}">--}}
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
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
                    <p> <span style="color:red">*</span> সব তথ্য পূরণ করতে হবে</p>
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

    <script type="text/javascript">
        $(function () {

            $('.date').datetimepicker({
                format: "YYYY-MM-DD",
                minDate: subtractYears(new Date(), 70),
                maxDate: subtractYears(new Date(), 18),
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
    </script>
@endpush
