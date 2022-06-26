<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">সকল উপজেলা</a></li>
        @if(Auth::user()->hasRole(['district admin']))
        <li><a href="#tab_2" data-toggle="tab">উপজেলা ওয়ারী</a></li>
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            @include('flash::message')
            <div class="form-row">
                <div class="form-group col-md-6">
                    {{ Form::label('lab_app_count', 'মোট ল্যাবের আবেদন সংখ্যা:') }}
                    {!! Form::text('lab_app_count', $applications, ['class' => 'form-control',"disabled"=>"true"]) !!}
                </div>
            </div>
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
                    {{ Form::label('remaining', 'আবেদন সমূহ যাচাই করা বাকি:') }}
                    {!! Form::text('remaining', $remaining , ['class' => 'form-control',"disabled"=>"true"]) !!}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_2">
            @if(Auth::user()->hasRole(['district admin']))
                @if(count($verified_upazilas_and_district_apps)>1)
                    <div class="form-group  col-md-12">
                        {{Form::label('app_upazila', 'উপজেলা') }}
                        {{Form::select('app_upazila', $verified_upazilas_and_district_apps, null,['id'=>'app_upazila','class'=>'form-control upazila-default'])}}
                    </div>
                @else
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4 class="callout callout-danger">উপজেলা কার্যালয়সমূহ হতে অদ্যাবধি কোনো আবেদন যাচাই করা হয়নি / প্রেরণ করা হলেও জেলা কার্যালয় কর্তৃক আবেদনসমূহ ভেরিফাই করা হয়নি। </h4>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

</div>

<!-- Submit Field -->

