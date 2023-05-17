@extends('layouts.dashboard')
@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    {{--<link rel="stylesheet" href="{{ asset('css/custom.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <!-- Main css -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    {{--<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
    {{--<link rel="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.bootstrap4.min.css" />--}}
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        .modal-footer{
            border-top: 0;
        }
        body {
            font-family: sans-serif;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1 class="text-center">আওতাধীন শেখ রাসেল ডিজিটাল ল্যাবের তালিকা {{ !empty(title())?'('.title().')':'' }}</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
        </div>
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
                <div class="form-row">
                    @if(Auth::user()->hasRole(['super admin','vendor','trainer']))
                    <div class="form-group  col-md-2">
                        {{Form::label('div', 'বিভাগ') }}
                        {{ Form::select('division', $divisionList,old('division'),array('class'=>'form-control','id'=>'div')) }}
                    </div>
                    <div class="form-group  col-md-2">
                        {{Form::label('dis', 'জেলা') }}
                        {{Form::select('district', ['0'=>'সকল'], old('district'),['id'=>'dis','class'=>'form-control'])}}
                    </div>
                    <div class="form-group  col-md-2">
                        {{Form::label('upazila', 'উপজেলা') }}
                        {{Form::select('upazila', ['0'=>'সকল'], old('upazila'),['id'=>'upazila','class'=>'form-control'])}}
                    </div>
                    @endif
                    @if(Auth::user()->hasRole(['district admin']))
                        <div class="form-group  col-md-2">
                            {{Form::label('upazila', 'উপজেলা') }}
                            {{Form::select('upazila', $upazilas, null,['id'=>'upazila','class'=>'form-control upazila-default'])}}
                            {{ Form::hidden('dis',$district_bn,['id'=>'dis']) }}
                        </div>
                    @endif
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="">ল্যাবের ধরণ</label>
                        {{Form::select('lab_type', array('0'=>'সকল ','srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার','srdl_sof' => 'স্কুল অফ ফিউচার ও শেখ রাসেল ডিজিটাল ল্যাব'), old('lab_type'),['class'=>'form-control', 'id'=>'lab_type',])}}
                    </div>

                    <div class="form-group col-md-2">
                        <label for=""></label>
                        <button class="btn btn-lg btn-success searchbtn"  value="submitted" id="searchbtn" type="submit"><i class="fas fa-search"></i> অনুসন্ধান</button>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    {{--<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>--}}
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <script src="{{ asset('web-theme/js/actived6c3d6c3.js?v=3.3')}}"></script>
    @include('applications.application-filterjs')


    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(function () {
            // $('.yajra-datatable').DataTable().clear().destroy();
            var filter= 0;
            $('button').click(function(){
                filter = 1;
            });
            var table = $("#dashboard-datatable");
            table.on('preXhr.dt',function (e,settings,d) {
                d.filter= filter,
                    d.phase = ($('#phase').val()) ? $('#phase').val() : '',
                    d.divId = ($('#div').val()) ? $('#div').val() : '',
                    d.disId = ($('#dis').val()) ? $('#dis').val() : '',
                    d.seat_type = ($('#seat_type').val()) ? $('#seat_type').val() : '',
                    d.parliamentaryConstituencyId = ($('#parliamentary_constituency').val()) ? $('#parliamentary_constituency').val() : '',
                    d.upazilaId= ($('#upazila').val()) ? $('#upazila').val() : '',
                    d.unionPourashavaWardId= ($('#union_pourashava_ward').val()) ? $('#union_pourashava_ward').val() : '',
                    d.lab_type= ($('#lab_type').val()) ? $('#lab_type').val() : ''
            })

            $('#searchbtn').click(function (e) {
                table.DataTable().ajax.reload();
                return false;
            });

            $('#dashboard-datatable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.DataTable().row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( template(row.data()) ).show();
                    tr.addClass('shown');
                }
            });
            function template ( d ) {
                // `d` is the original data object for the row
                return '<table class="table">'+
                    '<tr>'+
                    '<td>নির্বাচনী এলাকা :</td>'+
                    '<td>'+d.seat_no+' '+d.parliamentary_constituency+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>মাননীয় সংসদ সদস্যের নাম:</td>'+
                    '<td>'+d.attachment.member_name+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>ল্যাবের ধরণ</td>'+
                    '<td>'+d.lab_type+'</td>'+
                    '</tr>'+
                    '</table>';
            }




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

        });
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endpush

