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

@endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left">শেখ রাসেল ডিজিটাল ল্যাব স্থাপন প্রকল্প (২য় পর্যায়): Stocks</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
        </div>
        <div class="box box-primary">
            <div class="box-body">
                @if(Auth::user()->hasRole(['super admin']))
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
                        <label for="">কম্পিউটার ল্যাবের ধরণ</label>
                        {{Form::select('lab_type', array('0'=>'সকল ','srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার','srdl_sof' => 'স্কুল অফ ফিউচার ও শেখ রাসেল ডিজিটাল ল্যাব'), old('lab_type'),['class'=>'form-control', 'id'=>'lab_type',])}}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <button style="margin-top: 15px;" class="btn btn-lg btn-success searchbtn"  value="submitted" id="searchbtn" type="submit"><i class="fas fa-search"></i> অনুসন্ধান</button>
                    </div>
                </div>
                <div style="font-family: sans-serif;">{{ $dataTable->table(['class' => 'table table-bordered'], false) }}</div>

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
    @include('applications.edit-modal')
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
            $('#stock-datatable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');

            var table = $("#stock-datatable");
            table.on('preXhr.dt',function (e,settings,d) {
                d.filter= filter,
                    d.divId = ($('#div').val()) ? $('#div').val() : '',
                    d.disId = ($('#dis').val()) ? $('#dis').val() : '',
                    d.upazilaId= ($('#upazila').val()) ? $('#upazila').val() : '',
                    d.lab_type= ($('#lab_type').val()) ? $('#lab_type').val() : ''
            })

            $('#searchbtn').click(function (e) {
                table.DataTable().ajax.reload();
                return false;
            });
        });

    </script>

@endpush

