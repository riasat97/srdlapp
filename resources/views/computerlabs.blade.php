@extends('layouts.app')
@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            {{Form::open(array('route' => 'searchLabs','method' => 'GET','id'=>'search_from','class'=>'search-form'))}}
                            <div class="form-row">
                                <div class="form-group  col-md-4">
                                    {{Form::label('div', 'বিভাগ') }}
                                    {{ Form::select('division', $divisionList,'',array('class'=>'form-control','id'=>'div','style'=>'width:350px;')) }}

                                </div>
                                <div class="form-group  col-md-4">
                                    {{Form::label('dis', 'জেলা') }}
                                    {{Form::select('district', [], '',['id'=>'dis','class'=>'form-control','style'=>'width:350px;'])}}
                                    {{--                        <select name="district" id="dis" class="form-control" style="width:350px">--}}
                                    {{--                        </select>--}}
                                </div>
                                <div class="form-group  col-md-4">
                                    {{Form::label('upazila', 'উপজেলা') }}
                                    {{Form::select('upazila', [], '',['id'=>'upazila','class'=>'form-control','style'=>'width:350px;'])}}
                                </div>
                                <div class="form-group  col-md-12 ">
                                    <button type="submit" class="btn btn-outline-primary float-right"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            {{ Form::close() }}

                            {{--            data table start--}}
                            <div class="main-container" id="main-container">
                                <div class="main-content">
                                    <table class="table table-striped table-bordered table-hover " id="lab_list" style="width:100%" >
                                        <thead>
                                        <tr>
                                            <th>EIIN</th>
                                            <th>institution</th>
                                            <th>SRDL</th>
                                            <th>BCC</th>
                                            <th>MOE</th>
                                            <th>DSHE</th>
                                            <th>NGO</th>
                                            <th>Others</th>
                                            <th>Education Board</th>
                                            <th>Institution Self</th>
                                            <th>Local Government</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($labs as $key => $lab)
                                            <tr>
                                                <td>{{ $lab->eiin }}</td>
                                                <td>{{ $lab->institution }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_srdl }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_bcc }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_moe }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_dshe }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_ngo }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_others }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_edu_board }}</td>
                                                <td>{{ $lab->banbeisLab->own_lab }}</td>
                                                <td>{{ $lab->banbeisLab->lab_by_local_gov }}</td>
                                                <!-- we will also add show, edit, and delete buttons -->
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{--            data table end--}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section("js")
    <!-- JS -->
{{--    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}

    <script src="https://kit.fontawesome.com/5b67dd8eb0.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
    @include('bd.bdJs')

@endsection
