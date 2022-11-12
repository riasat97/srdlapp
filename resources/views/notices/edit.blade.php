@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Notice
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($notice, ['route' => ['notices.update', $notice->id], 'method' => 'patch','files' => true]) !!}

                        @include('notices.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
