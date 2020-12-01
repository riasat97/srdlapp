@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left">সংক্ষিপ্ত তথ্য</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <div class="container">
                    <div class="row">
                        <div class="four col-md-3">
                            <div class="counter-box "> <i class="fas fa-envelope"></i> <span class="counter">2147</span>
                                <p>৩৫০টি সংসদীয় আসনের মধ্যে
                                    ল্যাবের তালিকা পাঠানো আসন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fas fa-envelope-open"></i> <span class="counter">3275</span>
                                <p>৩৫০টি সংসদীয় আসনে
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fas fa-inbox"></i> <span class="counter">289</span>
                                <p>৫০টি সংরক্ষিত মহিলা আসনের মধ্যে
                                    ল্যাবের তালিকা পাঠানো আসন সংখ্যা</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fas fa-envelope-open"></i> <span class="counter">1563</span>
                                <p>৫০টি সংরক্ষিত মহিলা আসনে
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="four col-md-3">
                            <div class="counter-box "> <i class="fas fa-robot"></i> <span class="counter">2147</span>
                                <p>৩০০টি স্কুল অফ ফিউচারের জন্য
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fas fa-file-alt"></i><span class="counter">3275</span>
                                <p>অন্যান্য রেফারেন্সের মাধ্যমে
                                    প্রাপ্ত আবেদন সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fas fa-clipboard-list"></i><span class="counter">289</span>
                                <p>মাননীয় এমপি মহোদয়ের মাধ্যমে ল্যাবের জন্য তালিকা গ্রহণ সম্পন্ন হওয়া জেলার সংখ্যা </p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fas fa-mail-bulk"></i> <span class="counter">1563</span>
                                <p>মোট প্রাপ্ত
                                    আবেদন সংখ্যা </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.counter').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>

    <script>
        var x = document.getElementsByClassName("counter");
        var num = new Number(x).toLocaleString("bn-BD");
        x.innerHTML(num);
        document.write(num);

    </script>

@endpush
