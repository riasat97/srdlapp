@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"><i class="fas fa-lock"></i> পাসওয়ার্ড পরিবর্তন করুন</h1><br><br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @if(session()->has('success'))
            <span class="alert alert-success">
                        <strong>{{ session()->get('success') }}</strong>
            </span><br><br>
        @endif

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form method="POST" action="{{ route('change.password') }}">
                    @csrf

                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">বর্তমান পাসওয়ার্ড</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">নতুন পাসওয়ার্ড</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">নতুন পাসওয়ার্ডটি পুনরায় লিখুন</label>

                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                পাসওয়ার্ড আপডেট করুন
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
