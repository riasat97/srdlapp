@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <section class="content-header d-flex">
        @if(Auth::user()->hasRole(['super admin']))
        <h1 class="pull-left"><i class="fas fa-envelope-open-text"></i> সংক্ষিপ্ত তথ্য</h1> <br>
        @endif
        @if(Auth::user()->hasRole(['vendor']))
            <h1 class="text-center"><i class="fas fa-envelope-open-text"></i> প্রাপ্ত সাপোর্ট টিকেটসমূহের সংক্ষিপ্ত তথ্য</h1> <br>
        @endif
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        @if(Auth::user()->hasRole(['super admin']))
        <div class="box box-primary">
            <div class="box-body">
                <div class="container dashboard-container">
                    <div class="row dashboard-row">
                        <div class="four col-md-3 col-box">
                            <div class="counter-box "> <i class="fas fa-envelope"></i> <span class="counter" id="seats">{{$deo_app_seat_count}}</span>
                                <p>৩০০টি সংসদীয় আসনের মধ্যে
                                    ল্যাবের তালিকা পাঠানো আসন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3 col-box">
                            <div class="counter-box"> <i class="fas fa-envelope-open"></i> <span class="counter">{{$deo_app_seat_total}}</span>
                                <p>৩০০টি সংসদীয় আসন থেকে অদ্যাবধি
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3 col-box">
                            <div class="counter-box"> <i class="fas fa-inbox"></i> <span class="counter">{{$deo_app_reserved_seat_count}}</span>
                                <p>৫০টি সংরক্ষিত মহিলা আসনের মধ্যে
                                    ল্যাবের তালিকা পাঠানো আসন সংখ্যা</p>
                            </div>
                        </div>
                        <div class="four col-md-3 col-box">
                            <div class="counter-box"> <i class="fas fa-envelope-open"></i> <span class="counter">{{$deo_app_reserved_seat_total}}</span>
                                <p>৫০টি সংরক্ষিত মহিলা আসন থেকে অদ্যাবধি
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                    </div>

                    <div class="row dashboard-row">
                        <div class="four col-md-3 col-box">
                            <div class="counter-box"> <i class="fas fa-robot"></i> <span class="counter">{{$sof_total}}</span>
                                <p>৩০০টি স্কুল অফ ফিউচারের জন্য
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3 col-box">
                            <div class="counter-box"> <i class="fas fa-file-alt"></i><span class="counter">{{$other_ref}}</span>
                                <p>অন্যান্য রেফারেন্স থেকে
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
{{--                        <div class="four col-md-3 col-box">--}}
{{--                            <div class="counter-box"> <i class="fas fa-clipboard-list"></i><span class="counter">9</span>--}}
{{--                                <p>৬৪টি জেলার মধ্যে ডিও এর মাধ্যমে ল্যাবের তালিকা গ্রহণ সম্পন্ন হওয়া জেলার সংখ্যা</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="four col-md-6 col-box">
                            <div class="counter-box"> <i class="fas fa-mail-bulk"></i> <span class="counter">{{$total_app}}</span>
                                <p>মোট প্রাপ্ত
                                    আবেদন সংখ্যা </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(Auth::user()->hasRole(['vendor']))
            <div class="box box-primary">
                <div class="box-body">
                    <div class="container dashboard-container">
                        <div class="row dashboard-row">
                            <div class="four col-md-3 col-box">
                                <div class="counter-box "> <i class="fa fa-ticket"></i> <span class="counter" >{{$newTicket}}</span>
                                    <p>নতুন টিকেট সংখ্যা </p>
                                </div>
                            </div>
                            <div class="four col-md-3 col-box">
                                <div class="counter-box"> <i class="fas fa-envelope-open"></i> <span class="counter">{{$processingTicket}}</span>
                                    <p>প্রক্রিয়াধীন টিকেট সংখ্যা </p>
                                </div>
                            </div>
                            <div class="four col-md-3 col-box">
                                <div class="counter-box"> <i class="fas fa-thumbs-up"></i> <span class="counter">{{$resolvedTicket}}</span>
                                    <p>সমাধানকৃত টিকেট সংখ্যা </p>
                                </div>
                            </div>
                            <div class="four col-md-3 col-box">
                                <div class="counter-box"> <i class="fas fa-thumbs-down"></i> <span class="counter">{{$unresolvedTicket}}</span>
                                    <p>অমীমাংসিত টিকেট সংখ্যা </p>
                                </div>
                            </div>
                        </div>

                        <div class="row dashboard-row">
                            <div class="four col-md-12 col-box">
                                <div class="counter-box"> <i class="fas fa-mail-bulk"></i> <span class="counter">{{$totalTicket}}</span>
                                    <p>মোট টিকেট সংখ্যা</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::user()->hasRole(['district admin','upazila admin']))
            <div class="box">
                <div class="box-header"></div>
                <div class="box-body">
                    {{ Html::image('images/srdl-lab-conditions.png', 'alt text', array('class' => 'css-class img-responsive','height'=>'','width'=>'',)) }}
                </div>
            </div>
            <div class="box">
                <div class="box-header"></div>
                <div class="box-body">
                    {{ Html::image('images/sof-lab-conditions.png', 'alt text', array('class' => 'css-class img-responsive','height'=>'','width'=>'')) }}
                </div>
            </div>
            <div class="text-center">
                <div class="agree-btn">
                    <a href="{{route('web.selected-labs')}}">
                        <button class="btn btn-success btn-sm" type="button">
                            <i class="fa fa-check"></i> আমি সম্মত
                        </button>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('web-theme/js/plugins/jquery.matchHeight.js')}}"></script>
    <!-- ##### All Javascript Script ##### -->

    <!-- Popper js -->
    <script src="{{ asset('web-theme/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    {{--    <script src="web-theme/js/bootstrap/bootstrap.min.js)}}"></script>--}}
    <!-- LazyLoad js -->
    <script src="{{ asset('web-theme/js/plugins/lazyload.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('web-theme/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{ asset('web-theme/js/actived6c3d6c3.js?v=3.3')}}"></script>
@endpush
