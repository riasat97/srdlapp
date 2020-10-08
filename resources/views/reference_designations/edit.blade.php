@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Reference Designation
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($referenceDesignation, ['route' => ['referenceDesignations.update', $referenceDesignation->id], 'method' => 'patch']) !!}

                        @include('reference_designations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection