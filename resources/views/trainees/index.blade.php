@extends('layouts.app')
@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    {{--<link rel="stylesheet" href="{{ asset('css/custom.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <!-- Main css -->
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
    {{--<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
    {{--<link rel="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.bootstrap4.min.css" />--}}
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <style>

        body {
            font-family: sans-serif;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.css" rel="stylesheet">
    <link type="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css"/>
@endsection
@section('content')
    @if(!empty($lab) && Auth::user()->hasRole(['super admin','upazila admin','district admin']))
        <section class="content-header">
            <h1 class="pull-left">সকল প্রশিক্ষণার্থী</h1>
            <h2 class="institution">{{ $lab->ins }}</h2>
            <h1 class="pull-right">
                <a class="btn btn-primary pull-right" href="{{ route('labs.trainees.edit',$lab->id) }}"> <i
                        class="fa fa-plus"></i> নতুন প্রশিক্ষণার্থী</a>
            </h1>
        </section>
    @endif
    @if(empty($lab) && Auth::user()->hasRole(['upazila admin','district admin','super admin']))
        <section class="content-header">
            <h1 class="pull-left">প্রশিক্ষণার্থী পোর্টাল</h1>
            <h2 class="institution">সকল প্রশিক্ষণার্থী {{ !empty(title())?'('.title().')':'' }}</h2>
            <h1 class="pull-right">
                <a class="btn btn-primary pull-right" href="{{ route('web.selected-labs') }}"><i class="fa fa-plus"></i>
                    নতুন প্রশিক্ষণার্থী</a>
            </h1>
        </section>
    @endif
    @if(Auth::user()->hasRole(['trainer']))
        <section class="content-header">
            <h1 class="pull-left">প্রশিক্ষণার্থী পোর্টাল</h1>
            <h2 class="institution">সকল প্রশিক্ষণার্থী {{ !empty(title())?'('.title().')':'' }}</h2>
        </section>
    @endif
    <div class="content">
        <div class="clearfix"></div>
        <div id="alert-div" class="clearfix"></div>
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                @if(Auth::user()->hasRole(['super admin','district admin','upazila admin','trainer']))
                    <div class="form-row">
                        <div class="form-group  col-md-2">
                            {{Form::label('phase', 'পর্যায়') }}
                            {{ Form::select('phase', $phase,old('phase'),array('class'=>'form-control','id'=>'phase')) }}
                        </div>
                    </div>
                @endif
                @if(Auth::user()->hasRole(['super admin','trainer']))
                    <div class="form-row">
                        <div class="form-group  col-md-2">
                            {{Form::label('div', 'বিভাগ') }}
                            {{ Form::select('division', $divisionList,old('division'),array('class'=>'form-control','id'=>'div')) }}
                        </div>
                        <div class="form-group  col-md-2">
                            {{Form::label('dis', 'জেলা') }}
                            {{Form::select('district', ['0'=>'সকল'], old('district'),['id'=>'dis','class'=>'form-control'])}}
                            {{--                        <select name="district" id="dis" class="form-control" style="width:350px">--}}
                            {{--                        </select>--}}
                        </div>
                        <div class="form-group  col-md-2">
                            {{Form::label('upazila', 'উপজেলা') }}
                            {{Form::select('upazila', ['0'=>'সকল'], old('upazila'),['id'=>'upazila','class'=>'form-control'])}}
                        </div>
                    </div>
                @endif
                @if(Auth::user()->hasRole(['district admin']))
                    <div class="form-row">
                        <div class="form-group  col-md-2">
                            {{Form::label('upazila', 'উপজেলা') }}
                            {{Form::select('upazila', $upazilas, null,['id'=>'upazila','class'=>'form-control upazila-default'])}}
                            {{ Form::hidden('dis',$district_bn,['id'=>'dis']) }}
                        </div>
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="">ল্যাবের ধরণ</label>
                        {{Form::select('lab_type', array('0'=>'সকল ','srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার','srdl_sof' => 'স্কুল অফ ফিউচার ও শেখ রাসেল ডিজিটাল ল্যাব'), old('lab_type'),['class'=>'form-control', 'id'=>'lab_type',])}}
                    </div>
                </div>

                {{--                <div class="form-row">--}}
                {{--                    <div class="form-group col-md-2">--}}
                {{--                        <label for="">ডিভাইস স্ট্যাটাস</label>--}}
                {{--                        {{Form::select('device_status', array_merge(['0' => 'সকল'],device_status()), old('device_status'),['class'=>'form-control', 'id'=>'device_status_filter',])}}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-row">--}}
                {{--                    <div class="form-group col-md-2">--}}
                {{--                        <label for="">সাপোর্ট স্ট্যাটাস </label>--}}
                {{--                        {{Form::select('support_status', array_merge(['0' => 'সকল'],support_status()), old('support_status'),['class'=>'form-control', 'id'=>'support_status_filter',])}}--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for=""></label>
                        <button style="" class="btn btn-lg btn-success searchbtn  mt-2" value="submitted" id="searchbtn"
                                type="submit"><i class="fas fa-search"></i> অনুসন্ধান
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                @if(Auth::user()->hasRole(['district admin','upazila admin','super admin']))
                    <div class="form-row">
                        <div class="form-group  col-md-2">
                            {{Form::label('trainer', 'ভেন্ডর') }}
                            {{Form::select('trainer_id', $trainerList, null,['id'=>'trainer_id','class'=>'form-control'])}}
                        </div>
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="">Batch</label>
                        {{Form::number('batch',null,['min'=>1,'max'=>201,'class'=>'form-control', 'id'=>'search_batch'])}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for=""></label>
                        <button style="" class="btn btn-lg btn-success searchbtn mt-2" value="submitted" id="findBatch"
                                type="submit"><i class="fas fa-search"></i> find batch
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
        <div style="font-family: sans-serif;">{{ $dataTable->table(['class' => 'table table-bordered'], false) }}</div>
            </div>
        </div>

        <div class="text-center">
            @include('trainees.batch')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{--<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>--}}

    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    @include('applications.application-filterjs')
    {!! $dataTable->scripts() !!}

    {{--    @if(Auth::user()->hasRole(['upazila admin','district admin','super admin']))--}}
    @include('trainees.commonJs')
    {{--    @endif--}}
    <script>
        $('.modal').on('shown.bs.modal', function () {
            //Make sure the modal and backdrop are siblings (changes the DOM)
            $(this).before($('.modal-backdrop'));
            //Make sure the z-index is higher than the backdrop
            $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
        });
    </script>
@endpush
