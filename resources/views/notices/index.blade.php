@extends('layouts.dashboard')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Notices</h1>
        @if(!empty(Auth::user()) && Auth::user()->hasRole(['super admin']))
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('notices.create') }}">Add New</a>
        </h1>
        @endif
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('notices.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

