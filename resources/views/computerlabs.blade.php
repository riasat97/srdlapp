@extends('layouts.app')
@section('css')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
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
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js")
    <!-- JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('vendor/minimalist-picker/dobpicker.js')}}"></script>
    <script src="{{ asset('vendor/jquery.pwstrength/jquery.pwstrength.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/maximize-select2-height.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://kit.fontawesome.com/5b67dd8eb0.js" crossorigin="anonymous"></script>

    @include('bd.bdJs')

@endsection
