@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            ০৪ জন প্রশিক্ষণার্থীদের তালিকা
        </h1>
   </section>
   <div class="content">
       @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::open(['route' => ['institutions.trainees.update', $institution->id], 'method' => 'patch']) !!}

                        @include('trainees.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
