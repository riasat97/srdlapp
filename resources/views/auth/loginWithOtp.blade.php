@extends('layouts.app')

@section('content')
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><strong>{{ __('লগইন করুন ') }}</strong></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('loginWithOtp') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('আপনার মোবাইল নম্বর') }}</label>

                                <div class="col-md-7">
                                    <input id="mobile" type="number" class="form-control" name="mobile" required autofocus>

                                </div>
                            </div>



                            <div class="form-group row otp">
                                <label for="password" class="col-md-4 col-form-label text-md-right">OTP</label>

                                <div class="col-md-7">

                                    <input id="otp" type="number" class="form-control" name="otp" >
                                </div>
                            </div>


                            <div class="form-group row mb-0 otp">
                                <div class="col-md-7 offset-md-5">
                                    <a class="btn btn-success otp-btn" onclick="sendOtp()">OTP প্রেরণ করুন </a>
                                    <button type="submit" class="btn btn-primary otp-submit-btn">
                                        {{ __('প্রবেশ করুন') }}
                                    </button>
                                </div>

                            </div>
                        </form>
{{--                        <div class="form-group row send-otp">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button class="btn btn-success" onclick="sendOtp()">OTP প্রেরণ করুন </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>

    <script>

        //$('.otp').hide();
        function sendOtp() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // alert($('#mobile').val());
            $.ajax( {
                url:'sendOtp',
                type:'post',
                data: {'mobile': $('#mobile').val()},
                success:function(data) {
                    // alert(data);
                    if(data != 0){
                        $('.otp').show();
                        $('.send-otp').hide();
                    }else{
                        alert('Mobile No not found');
                    }

                },
                error:function () {
                    console.log('error');
                }
            });
        }
    </script>
@endsection
