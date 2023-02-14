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
@endsection
@section('content')
    @if(!empty($lab) && Auth::user()->hasRole(['super admin','upazila admin','district admin']))
    <section class="content-header">
        <h1 class="pull-left">সকল অভিযোগ</h1>
        <h2 class="institution">{{ $lab->ins }}</h2>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" href="{{ route('labs.supports.index',$lab->id) }}"> <i class="fa fa-plus"></i> নতুন অভিযোগ</a>
        </h1>
    </section>
    @endif
    @if(empty($lab) && Auth::user()->hasRole(['upazila admin','district admin','super admin']))
        <section class="content-header">
            <h1 class="pull-left">অভিযোগ পোর্টাল</h1>
            <h2 class="institution">সকল অভিযোগ</h2>
            <h1 class="pull-right">
                @if(Auth::user()->hasRole(['upazila admin','district admin']))
                <a class="btn btn-primary pull-right" href="{{ route('web.selected-labs') }}">আওতাধীন ল্যাবসমূহ</a>
                @else
                <a class="btn btn-primary pull-right"  href="{{ route('web.selected-institutions') }}">সকল ল্যাব</a>
                @endif
            </h1>
        </section>
    @endif
    @if(Auth::user()->hasRole(['vendor']))
        <section class="content-header">
            <h1 class="pull-left">সকল অভিযোগ</h1>
            <h2 class="institution">{{ $vendor->name }}</h2>
        </section>
    @endif
    <div class="content">
        <div class="clearfix"></div>
        @include('supports.form')
        @include('supports.ticketShow')
        <div id="alert-div" class="clearfix"></div>
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                @if(Auth::user()->hasRole(['super admin','district admin','upazila admin']))
                <div class="form-row">
                        <div class="form-group  col-md-2">
                            {{Form::label('phase', 'পর্যায়') }}
                            {{ Form::select('phase', $phase,old('phase'),array('class'=>'form-control','id'=>'phase')) }}
                        </div>
                </div>
                @endif
                @if(Auth::user()->hasRole(['super admin','vendor']))
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
                    @if(!Auth::user()->hasRole(['vendor']))
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="">ডিভাইসের ধরণ  </label>
                            {{Form::select('device_type', array_merge(['0' => 'সকল'],device()), old('device_type'),['class'=>'form-control', 'id'=>'device_type_filter',])}}
                        </div>
                    </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="">ডিভাইস স্ট্যাটাস</label>
                            {{Form::select('device_status', array_merge(['0' => 'সকল'],device_status()), old('device_status'),['class'=>'form-control', 'id'=>'device_status_filter',])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="">সাপোর্ট স্ট্যাটাস </label>
                            {{Form::select('support_status', array_merge(['0' => 'সকল'],support_status()), old('support_status'),['class'=>'form-control', 'id'=>'support_status_filter',])}}
                        </div>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for=""></label>
                        <button style="" class="btn btn-lg btn-success searchbtn mt-2"  value="submitted" id="searchbtn" type="submit"><i class="fas fa-search"></i> অনুসন্ধান</button>
                    </div>
                </div>
                <div style="font-family: sans-serif;">{{ $dataTable->table(['class' => 'table table-bordered'], false) }}</div>

            </div>
        </div>
        <div class="text-center">

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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    @include('applications.application-filterjs')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(function () {
            // $('.yajra-datatable').DataTable().clear().destroy();
            var filter= 0;
            $('button').click(function(){
                filter = 1;
            });
            $('#ticket-datatable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');

            var table = $("#ticket-datatable");
            table.on('preXhr.dt',function (e,settings,d) {
                d.filter= filter,
                    d.phase = ($('#phase').val()) ? $('#phase').val() : '',
                    d.divId = ($('#div').val()) ? $('#div').val() : '',
                    d.disId = ($('#dis').val()) ? $('#dis').val() : '',
                    d.upazilaId= ($('#upazila').val()) ? $('#upazila').val() : '',
                    d.lab_type= ($('#lab_type').val()) ? $('#lab_type').val() : '',

                    d.device_type= ($('#device_type_filter').val()) ? $('#device_type_filter').val() : '',
                    d.device_status= ($('#device_status_filter').val()) ? $('#device_status_filter').val() : '',
                    d.support_status= ($('#support_status_filter').val()) ? $('#support_status_filter').val() : ''
            })

            $('#searchbtn').click(function (e) {
                table.DataTable().ajax.reload();
                return false;
            });
        });

    </script>
{{--    @if(Auth::user()->hasRole(['upazila admin','district admin','super admin']))--}}
    @include('supports.commonJs')
{{--    @endif--}}
    <script>
        $('.modal').on('shown.bs.modal', function() {
            //Make sure the modal and backdrop are siblings (changes the DOM)
            $(this).before($('.modal-backdrop'));
            //Make sure the z-index is higher than the backdrop
            $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
        });
    </script>
@endpush
