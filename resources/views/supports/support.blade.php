@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Support Portal</h1>
        <h2 class="institution">{{ $lab->ins }}</h2>
        <div class="lab_id hidden">{{ $lab->id }}</div>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right"  target="_blank" href="{{ route('labs.tickets.index',['lab_id'=>$lab->id]) }}">All Tickets</a>
        </h1>
    </section>
    <div class="content">
        <div id="alert-div" class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        @if(in_array($lab->lab_type,['srdl','srdl_sof']))
        <div class="box box-primary">
            <div class="box-body">
                <div class="header-container">
                    <img src="https://srdl.gov.bd/assets/img/srdl.png" width="80px" alt="">
                    <h4 class="section-title"> <strong>Sheikh Russel Digital Lab (SRDL) Devices</strong> </h4>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/428/428001.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Laptop</h5>
                                <p class="card-text">Quantity: 17</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="laptop" onclick="">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/5371/5371951.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">LED Smart TV</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="led_tv" onclick="">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/1497/1497542.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Printer</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="printer">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/1497/1497540.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Scanner</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="scanner">Support</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/4703/4703701.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Web Camera</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="web_camera">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/4347/4347183.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Router</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="router">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/5517/5517192.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Network Switch with LAN Connectivity</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="network_switch">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/7554/7554159.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Internet Connectivity (6 months)</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="internet_connectivity">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <div class="card">--}}
{{--                            <img src="https://cdn-icons-png.flaticon.com/512/1189/1189360.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title card">Furniture</h5>--}}
{{--                                <p class="card-text">Table Quantity: 17 & Chair Quantity: 33</p>--}}
{{--                                <a href="#!" class="btn btn-primary device_type" data-id="furniture">Support</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
        @endif

        @if(in_array($lab->lab_type,['sof','srdl_sof']))
        <div class="box box-primary">
            <div class="box-body">
                <div class="header-container">
                    <img class="logo" src="https://srdl.gov.bd/assets/img/srdl%20circle.png" width="80px" alt="">
                    <h4 class="section-title"> <strong>Sheikh Russel School of Future (SR SOF) Devices</strong> </h4>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/2201/2201139.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Digital Smart Board</h5>
                                <p class="card-text">Quantity: 06</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="smart_board">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/748/748561.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Desktop Computer</h5>
                                <p class="card-text">Quantity: 04</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="desktop">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/3454/3454877.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Attendance Reader Machine</h5>
                                <p class="card-text">Quantity: 05</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="attendance_reader">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/164/164397.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Digital ID Card</h5>
                                <p class="card-text">Quantity: 1000</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="digital_id_card">Support</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <img src="https://cdn-icons-png.flaticon.com/512/2933/2933987.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                            <div class="card-body">
                                <h5 class="card-title card">Wi-Fi Router</h5>
                                <p class="card-text">Quantity: 01</p>
                                <a href="#!" class="btn btn-primary device_type" data-id="wifi_router">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
        <div class="box-body">
            <div class="header-container">
                <img class="logo" src="https://sof.edu.bd/assets/img/logo.png" width="80px" alt="">
                <h4 class="sof"> <strong>Sheikh Russel School of Future Learning Management System (SR-SOF LMS) Software</strong> </h4>
            </div>
            <div class="coming-soon">Coming Soon!!!</div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/5423/5423996.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                            <h5 class="card-title card">Result Processing</h5>
{{--                            <p class="card-text">Quantity: 06</p>--}}
                            <a href="#!" class="btn btn-primary service_type" data-id="result_processing">Support</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/2883/2883733.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                            <h5 class="card-title card">Online Admission/Tuition Fee</h5>
{{--                            <p class="card-text">Quantity: 04</p>--}}
                            <a href="#!" class="btn btn-primary service_type" data-id="online_fee">Support</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/6612/6612108.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                            <h5 class="card-title card">Online Attendance System</h5>
{{--                            <p class="card-text">Quantity: 05</p>--}}
                            <a href="#!" class="btn btn-primary service_type" data-id="online_attendance_system">Support</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                <div class="card">
                    <img src="https://cdn-icons-png.flaticon.com/512/1067/1067566.png" width="100px" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body">
                        <h5 class="card-title card">General Issues</h5>
{{--                        <p class="card-text">Quantity: 05</p>--}}
                        <a href="#!" class="btn btn-primary service_type" data-id="general_issues">Support</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
        @endif
        <div class="text-center">

        </div>
    </div>
    @include('supports.form')
@endsection

@push('scripts')
    @include('supports.commonJs')
    <script>
        $('.modal').on('shown.bs.modal', function() {
            $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
        });
    </script>

@endpush
