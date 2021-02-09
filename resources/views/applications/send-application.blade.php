@include('flash::message')

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('verified_apps', 'যাচাই করা ল্যাবের আবেদন সংখ্যা:') }}
        {!! Form::text('verified_apps', $verified_apps , ['class' => 'form-control',"disabled"=>"true"]) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('duplicate_apps', 'ডুপ্লিকেট চিহ্নিত করা আবেদন সংখ্যা:') }}
        {!! Form::text('duplicate_apps', $duplicate_apps , ['class' => 'form-control',"disabled"=>"true"]) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('lab_app_count', 'মোট ল্যাবের আবেদন সংখ্যা:') }}
        {!! Form::text('lab_app_count', $applications, ['class' => 'form-control',"disabled"=>"true"]) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('remaining', 'আবেদনসমূহ যাচাই করা বাকি:') }}
        {!! Form::text('remaining', $remaining , ['class' => 'form-control',"disabled"=>"true"]) !!}
    </div>
</div>
<!-- Submit Field -->

