@extends('layouts.app')
@section('css')
    {{--<meta name="_token" content="{{csrf_token()}}" />--}}
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <!-- Main css -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .modal-footer{
            border-top: 0;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left"><i class="fas fa-mail-bulk"></i> শেখ রাসেল ডিজিটাল ল্যাব/ স্কুল অফ ফিউচারের জন্য প্রাপ্ত আবেদনসমূহ</h1><br>
        @if(Auth::user()->hasRole(['super admin']))
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('applications.apply') }}"><i class="fas fa-plus-circle"></i> নতুন আবেদন</a>
        </h1>
        @endif
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-row">
                    @if(Auth::user()->hasRole(['super admin']))
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
                    @endif
                    @if(Auth::user()->hasRole(['super admin']))
                            <div class="form-group  col-md-2">
                                {{Form::label('seat_type', 'সংসদীয় আসনের ধরণ') }}
                                {{Form::select('seat_type', ['0'=>'সকল ','general'=>'সাধারণ', 'reserved'=>'সংরক্ষিত মহিলা আসন'], old('seat_type'),['id'=>'seat_type','class'=>'form-control'])}}
                            </div>
                    @endif
                    @if(Auth::user()->hasRole(['super admin']))
                        <div class="form-group  col-md-2">
                            {{Form::label('parliamentary_constituency', 'নির্বাচনী এলাকা') }}
                            {{Form::select('parliamentary_constituency', ['0'=>'সকল'], old('parliamentary_constituency'),['id'=>'parliamentary_constituency','class'=>'form-control'])}}
                        </div>
                    @endif
{{--                    @if(Auth::user()->hasRole(['district admin']))--}}
{{--                        <div class="form-group  col-md-3">--}}
{{--                            {{Form::label('parliamentary_constituency', 'নির্বাচনী এলাকা') }}--}}
{{--                            {{Form::select('parliamentary_constituency', $parliamentaryConstituencyList, null,['id'=>'parliamentary_constituency','class'=>'form-control'])}}--}}
{{--                            --}}{{--<button class="btn btn-lg btn-success pull-right" id="searchbtn" style="margin-top: 3px;" type="submit">Search</button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    @if(Auth::user()->hasRole(['super admin']))
                        <div class="form-group  col-md-2">
                            {{Form::label('upazila', 'উপজেলা') }}
                            {{Form::select('upazila', ['0'=>'সকল'], old('upazila'),['id'=>'upazila','class'=>'form-control'])}}
                        </div>
                    @endif

                    @if(Auth::user()->hasRole(['district admin']))
                        <div class="form-group  col-md-2">
                            {{Form::label('upazila', 'উপজেলা') }}
                            {{Form::select('upazila', $upazilas, null,['id'=>'upazila','class'=>'form-control upazila-default'])}}
                        </div>
                    @endif

                    @if(Auth::user()->hasRole(['super admin']))
                            <div class="form-group  col-md-2">
                                {{Form::label('union_pourashava_ward', 'ইউনিয়ন/পৌরসভা ') }}
                                {{Form::select('union_pourashava_ward', ['0'=>'সকল'], old('union_pourashava_ward'),['id'=>'union_pourashava_ward','class'=>'form-control'])}}
                            </div>
                    @endif
                </div>
                <div class="form-row">
                    @if(Auth::user()->hasRole(['super admin']))
                        <div class="form-group col-md-2">
                            <label for="">কম্পিউটার ল্যাবের ধরণ</label>
                            {{Form::select('lab_type', array('0'=>'সকল ','srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার'), old('lab_type'),['class'=>'form-control', 'id'=>'lab_type',])}}
                        </div>
                    @endif
                    @if(Auth::user()->hasRole(['super admin']))
                        <div class="form-group col-md-2">
                            <label for="">আবেদনের ধরণ </label>
                            {{Form::select('application_type', array('0'=>'সকল ','listed_by_deo' => 'ডিও', 'ref' => 'অন্যান্য রেফারেন্স'), old('application_type'),['class'=>'form-control', 'id'=>'application_type',])}}
                        </div>
                    @endif
                    @if(Auth::user()->hasRole(['super admin','district admin']))
                        <div class="form-group col-md-3">
                            <button class="btn btn-lg btn-success searchbtn"  value="submitted" id="searchbtn" type="submit"><i class="fas fa-search"></i> অনুসন্ধান</button>
                        </div>
                    @endif

                </div>
                <div class="form-row">
                    @if(Auth::user()->hasRole(['district admin']) && Auth::user()->verified!='YES')
                        <div class="form-group col-md-12">
                            <button type="button" id="send-apps" class="btn btn-info "><i class="fas fa-paper-plane"></i> যাচাইকৃত ল্যাবের আবেদনসমূহ প্রকল্প দপ্তরে প্রেরণ করুন  </button>
                        </div>
                    @endif
                </div>
                <div id="alert-div">

                </div>
                @include('applications.table')
            </div>
        </div>
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
    @include('applications.edit-modal')
    @include('applications.show-modal')
    @include('applications.duplicate-modal')
    @include('applications.sendApps-modal')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    @include('applications.application-filterjs')

    <script type="text/javascript">

        $(function () {
                var filter= 0;
                $('button').click(function(){
                    filter = 1;
                });
            // $('.yajra-datatable').DataTable().clear().destroy();
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    "pageLength": 25,
                    //scrollX:  true,
                    "sScrollX": "100%",
                    "bScrollCollapse": true,
                    // responsive: true,
                    // 'paging'      : true,
                    // 'lengthChange': false,
                    // 'info'        : true,
                    // 'autoWidth'   : false,
                    ajax: {
                        url: "{{ route('applications.index') }}",
                        data: function (d) {
                            d.filter= filter,
                            d.divId = ($('#div').val()) ? $('#div').val() : '',
                            d.disId = ($('#dis').val()) ? $('#dis').val() : '',
                            d.seat_type = ($('#seat_type').val()) ? $('#seat_type').val() : '',
                            d.parliamentaryConstituencyId = ($('#parliamentary_constituency').val()) ? $('#parliamentary_constituency').val() : '',
                            d.upazilaId= ($('#upazila').val()) ? $('#upazila').val() : '',
                            d.unionPourashavaWardId= ($('#union_pourashava_ward').val()) ? $('#union_pourashava_ward').val() : '',
                            d.lab_type= ($('#lab_type').val()) ? $('#lab_type').val() : '',
                            d.application_type= ($('#application_type').val()) ? $('#application_type').val() : ''
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'division', name: 'division'},
                        {data: 'district', name: 'district'},
                        {data: 'constituency', name: 'constituency'},
                        {data: 'upazila', name: 'upazila'},
                        {data: 'institution_bn', name: 'institution_bn'},
                        {data: 'application_type', name: 'application_type'},
                        {
                            className: 'details-control',
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ],
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        //console.log(aData["lab_type"]);
                        if (aData["lab_type"] == "স্কুল অফ ফিউচার") {
                            $('td', nRow).css('background-color', 'Cornsilk');
                        }
                    }


                });
            @if(!Auth::user()->hasRole(['super admin']))
            table.columns( [6] ).visible( false );
            @endif
            table.columns.adjust().draw();
            $('#searchbtn').click(function (e) {
                table.draw();
            });

          //  $(".yajra-datatable").css({"width":"100%"});
            @if(Auth::user()->hasRole(['super admin']))
            $('.yajra-datatable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

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
            @endif
            function template ( d ) {
                // `d` is the original data object for the row
                if(d.listed_by_deo=="YES"){
                    var member_name=$.isEmptyObject(d.attachment)?'':d.attachment.member_name;
                    if(d.attachment.list_attachment_file){
                        //($.isEmptyObject(d.attachment));
                        return '<table class="table">'+
                            '<tr>'+
                            '<td>নির্বাচনী এলাকা :</td>'+
                            '<td>'+d.seat_no+' '+d.parliamentary_constituency+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>মাননীয় সংসদ সদস্যের নাম:</td>'+
                            '<td>'+ member_name +'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>প্রেরিত তালিকার স্ক্যান কপি (পিডিএফ): </td>'+
                            '<td> <a href='+d.attachment.list_attachment_file+' target=_blank>'+d.attachment.list_attachment_file_path_type+'</a></td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td>ল্যাবের ধরণ</td>'+
                            '<td>'+d.lab_type+'</td>'+
                            '</tr>'+
                            '</table>';
                    }
                    else
                    return '<table class="table">'+
                        '<tr>'+
                        '<td>নির্বাচনী এলাকা :</td>'+
                        '<td>'+d.seat_no+' '+d.parliamentary_constituency+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>মাননীয় সংসদ সদস্যের নাম:</td>'+
                        '<td>'+member_name+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>ল্যাবের ধরণ</td>'+
                        '<td>'+d.lab_type+'</td>'+
                        '</tr>'+
                        '</table>';
                }
                else if(d.attachment.ref_type)
                    return '<table class="table">'+
                        '<tr>'+
                        '<td>সুপারিশকারীর পরিচয়: </td>'+
                        '<td>'+d.attachment.ref_type+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>সুপারিশকারীর নাম: </td>'+
                        '<td>'+d.attachment.ref_name+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>সুপারিশকারীর পদবী: </td>'+
                        '<td>'+d.attachment.ref_designation+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<tr>'+
                        '<td>সুপারিশকারীর কর্মস্থল: </td>'+
                        '<td>'+d.attachment.ref_office+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<tr>'+
                        '<td>সুপারিশ সম্পর্কিত ডকুমেন্টস: </td>'+
                        '<td> <a href='+d.attachment.ref_documents_file+' target=_blank>'+d.attachment.ref_documents_file_path_type+'</a></td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>ল্যাবের ধরণ</td>'+
                        '<td>'+d.lab_type+'</td>'+
                        '</tr>'+
                        '</table>';
            }

            $('body').on('click', '.view', function () {
                var app_id = $(this).data('id');
                $.get("{{ route('applications.show', '') }}" +'/' + app_id, function (data) {
                    console.log(data);
                    $('.modal-title').html("শেখ রাসেল ডিজিটাল ল্যাব/ স্কুল অফ ফিউচারের জন্য প্রাপ্ত আবেদন");
                    $('.modal-body').html(data);
                    $('.btn-primary').val("verify");
                    $('#showApplicationModal .toggle').bootstrapToggle();
                    $('#showApplicationModal').modal('show');
                    //$('#product_id').val(data.id);
                    //$('#name').val(data.name);
                    //$('#detail').val(data.detail);
                })

            });

            $('body').on('click', '.duplicate', function () {
                var app_id = $(this).data('id');
                $.get("{{ route('applications.index') }}" +'/' + app_id +'/duplicate', function (data) {
                    console.log(data);
                    //$('.modal-title').html("ডুপ্লিকেট  আবেদন");
                    $('.alert-danger').html('');
                    $('.modal-body').html(data);
                    $('.btn-primary').val("submit");
                    $('#duplicateApplicationModal .toggle').bootstrapToggle();
                    $('#duplicateApplicationModal').modal('show');
                    //$('#product_id').val(data.id);
                    //$('#name').val(data.name);
                    //$('#detail').val(data.detail);
                })
            });


            $('#formSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var app_id=  $(".appId").val();

                $.ajax({
                    url: "{{ route('applications.index') }}" +'/' + app_id +'/duplicate',
                    type:"patch",
                    data:$('#postDuplicate').serialize(),
                    success:function(response){
                        console.log(response);
                        if(response.dup){
                            iziToast.error({
                                title: 'Error',
                                message: 'আপনি ইতোপূর্বে আবেদনটিকে ডুপ্লিকেট হিসাবে চিহ্নিত করেছেন!',
                            });
                            $('#duplicateApplicationModal').modal('hide');
                            $('.alert-danger').hide();
                        }
                        else{
                            iziToast.success({
                                title: 'Success',
                                message: 'Successfully updated!',
                            });
                            $('#duplicateApplicationModal').modal('hide');
                            $('.alert-danger').hide();
                        }
                    },
                    error: function(xhr) {
                        $('.alert-danger').html('');
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>'+value+'</li>');
                        });

                    }
                });
            });
            $('body').on('click', '#send-apps', function () {
                $.get("{{ route('applications.stat') }}", function (data) {
                    console.log(data);
                    //$('.modal-title').html("ডুপ্লিকেট  আবেদন");
                    $('.alert-danger').html('');
                    $('.modal-body').html(data);
                    $('.btn-primary').val("submit");
                    $('#sendAppsModal .toggle').bootstrapToggle();
                    $('#sendAppsModal').modal('show');
                    //$('#product_id').val(data.id);
                    //$('#name').val(data.name);
                    //$('#detail').val(data.detail);
                })
            });
            $('#sendApplications').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('applications.send') }}" ,
                    type:"patch",
                    data:$('#sendApps').serialize(),
                    success:function(response){
                        console.log(response);
                        if(response.success){
                            iziToast.success({
                                title: 'Success',
                                message: response.message,
                            });
                            $('#sendAppsModal').modal('hide');
                            $('#send-apps').hide();
                            $('.verify').hide();
                            $('.duplicate').hide();
                            $('.viewForm').removeAttr('style');
                            $('.alert-danger').hide();
                        }
                        else{
                            iziToast.error({
                                title: 'Error',
                                message: response.message,
                            });
                            $('#sendAppsModal').modal('hide');
                            $('.alert-danger').hide();
                        }
                    },
                });
            });

            $(document).on('click','.edit',function () {
                var application = $(this).data('application');
                console.log(application);
                if(application){
                    $('#applicationInstituteNameInEditModal').html(application.institution)

                    var updateUrl = $('#editApplicationModal form').attr('action')
                    updateUrl = updateUrl.replace(':applicationId', application.id)
                    $('#editApplicationModal form').attr('action', updateUrl)

                    $('#editApplicationModal .form-control').each(function () {
                        if($(this).attr('type')==="checkbox"){
                            if(application[$(this).attr('name')]==='YES'){
                                $(this).attr('checked','checked')
                            }
                            if($(this).attr('name')==='is_mpo' && application['mpo']){
                                $(this).attr('checked','checked')
                            }
                        }else{
                            $(this).val(application[$(this).attr('name')])
                            if(
                                (
                                    $(this).attr('name')==='mpo'
                                    || $(this).attr('name')==='internet_connection_type'
                                )
                                && application[$(this).attr('name')]
                            ){
                                $(this).prop('disabled',false)
                            }
                        }
                    })

                    $('#editApplicationModal .toggle').bootstrapToggle();

                    $('#editApplicationModal').modal('show')
                }
            })

            $('#editApplicationModal').on('hidden.bs.modal', function () {
                $('#editApplicationModal .toggle').bootstrapToggle('destroy');
            })
            $('#showApplicationModal').on('hidden.bs.modal', function () {
                $('#showApplicationModal .toggle').bootstrapToggle('destroy');
            })

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

            $('#updateApplication').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    url: $(this).attr('action'),
                    type:"POST",
                    data: $(this).serializeArray(),
                    success:function(response){
                        iziToast.success({
                            title: 'Success',
                            message: 'Successfully updated!',
                        });
                        $('#editApplicationModal').modal('hide')
                    },
                });
            })

        });
    </script>


    @if(Auth::user()->hasRole(['district admin']))
       {{-- <script type="text/javascript">
            $(function () {
                $('select.upazila-default option:first').attr('disabled', true);
            });
        </script>--}}
    @endif

@endpush
