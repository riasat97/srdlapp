
@if(!empty($application->verification) && $application->verification->app_duplicate=='YES')

    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('duplicate', 'ডুপ্লিকেট আবেদনকৃত প্রতিষ্ঠানটির নাম:') }}
            {!! Form::text('institution_bn', $application->institution_bn, ['class' => 'form-control',"disabled"=>"true"]) !!}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('app_original_id', 'অরিজিনালি আবেদনকৃত প্রতিষ্ঠানটির নাম:') }}
            {{Form::select('app_original_id',$institutions,$application->verification->app_original_id??null,['class'=>'form-control', 'id'=>'app_original_id',"disabled"=>"true"])}}
        </div>
    </div>
    {!! Form::hidden('remove_duplicate_id', $application->id , ['class' => 'form-control appId']) !!}
    <div class="form-row">
        <div class="form-group col-md-12">
            <h4 class="callout callout-default">@include('flash::message')</h4>
        </div>
    </div>
@else
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('duplicate', 'ডুপ্লিকেট আবেদনকৃত প্রতিষ্ঠানটির নাম:') }}
            {!! Form::text('institution_bn', $application->institution_bn, ['class' => 'form-control',"disabled"=>"true"]) !!}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('srdl_code', 'SRDL CODE:') }}
            {!! Form::text('srdl_code', $application->id , ['class' => 'form-control',"disabled"=>"true"]) !!}
            {!! Form::hidden('id', $application->id , ['class' => 'form-control appId',"disabled"=>"true"]) !!}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('app_original_id', 'অরিজিনালি আবেদনকৃত প্রতিষ্ঠানটির নাম:') }}
            {{Form::select('app_original_id',$institutions,$application->verification->app_original_id??null,['class'=>'form-control', 'id'=>'app_original_id'])}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('app_original_comments', 'মন্তব্য (যদি থাকে):') }}
            {!! Form::textarea ('app_original_comments', $application->verification->app_original_comments??'' , ['class' => 'form-control','id'=>'app_original_comments','rows'=>"3"]) !!}
        </div>
    </div>
@endif
<!-- Submit Field -->

