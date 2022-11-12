@extends('layouts.main')
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
        <h1 class="pull-left">নোটিশ বোর্ড</h1>
        @if(!empty(Auth::user()) && Auth::user()->hasRole(['super admin']))
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('notices.create') }}"><i class="fas fa-plus-circle"></i> নতুন নোটিশ </a>
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


    {!! $dataTable->scripts() !!}

    <script type="text/javascript">

            function Conform_Delete()
            {
                return confirm("Are You Sure Want to Delete?");
            }

    </script>

@endpush

