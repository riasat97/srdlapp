@extends('layouts.app')
@section('css')
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
        <h1 class="pull-left">SRDL Applications</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('applications.apply') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix">
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-row">
                    <div class="form-group  col-md-3">
                        {{Form::label('div', 'বিভাগ') }}
                        {{ Form::select('division', $divisionList,old('division'),array('class'=>'form-control','id'=>'div')) }}
                    </div>
                    <div class="form-group  col-md-3">
                        {{Form::label('dis', 'জেলা') }}
                        {{Form::select('district', [old('district')=>old('district')], old('district'),['id'=>'dis','class'=>'form-control'])}}
                        {{--                        <select name="district" id="dis" class="form-control" style="width:350px">--}}
                        {{--                        </select>--}}
                    </div>
                    <div class="form-group  col-md-3">
                        {{Form::label('parliamentary_constituency', 'নির্বাচনী এলাকা') }}
                        {{Form::select('parliamentary_constituency', [old('parliamentary_constituency')=>old('parliamentary_constituency')], old('parliamentary_constituency'),['id'=>'parliamentary_constituency','class'=>'form-control'])}}
                        <button class="btn btn-lg btn-success pull-right" id="searchbtn" style="margin-top: 3px;" type="submit">Search</button>
                    </div>

                </div>

                @include('applications.table')
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
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    @include('applications.application-searchjs')
    <script type="text/javascript">

        $('#searchbtn').click(function (e) {
            $('.yajra-datatable').DataTable().clear().destroy();
            var divID = ($('#div').val())?$('#div').val():'';
            var disID = ($('#dis').val())?$('#dis').val():'';
            var parliamentaryConstituencyID = ($('#parliamentary_constituency').val())?$('#parliamentary_constituency').val():'';

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('applications.index') }}?divId="+divID+"&disId="+disID+"&parliamentaryConstituencyId="+parliamentaryConstituencyID,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'division', name: 'division'},
                    {data: 'district', name: 'district'},
                    {data: 'upazila', name: 'upazila'},
                    {data: 'institution_bn', name: 'institution_bn'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('applications.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'division', name: 'division'},
                    {data: 'district', name: 'district'},
                    {data: 'upazila', name: 'upazila'},
                    {data: 'institution_bn', name: 'institution_bn'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            $(document).on('click','.edit',function () {
                var application = $(this).data('application')
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

    <script type="text/javascript">
        $(function () {
            $("#is_mpo").change(function () {

                if ($(this).prop("checked") == true) {
                    $("#mpo").removeAttr("disabled");
                    $("#mpo").focus();
                } else {
                    $("#mpo").attr("disabled", "disabled");
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
@endpush
