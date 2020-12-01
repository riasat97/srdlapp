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
                            <div class="counter-box colored"> <i class="fa fa-thumbs-o-up"></i> <span class="counter">2147</span>
                                <p>Happy Customers</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fa fa-group"></i> <span class="counter">3275</span>
                                <p>Registered Members</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fa fa-shopping-cart"></i> <span class="counter">289</span>
                                <p>Available Products</p>
                            </div>
                        </div>
                        <div class="four col-md-3">
                            <div class="counter-box"> <i class="fa fa-user"></i> <span class="counter">1563</span>
                                <p>Saved Trees</p>
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
@endpush
