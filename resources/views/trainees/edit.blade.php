@extends('layouts.app')
@section('css')
    <link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
@endsection
@section('content')
    <section class="content-header">
        <h1>
            ০৪ জন প্রশিক্ষণার্থীদের তালিকা
        </h1>
   </section>
   <div class="content">
       @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::open(['route' => ['labs.trainees.update', $lab->id], 'method' => 'patch']) !!}

                        @include('trainees.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $('#age1,#age2,#age3,#age4').datetimepicker({
                format: "DD/MM/YYYY",
            });
        });
    </script>

@endpush
