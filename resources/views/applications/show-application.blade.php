<div class="form-row">
    <div class="form-group">
        {{ Form::label('lab_type', 'কম্পিউটার ল্যাবের ধরণ:') }}
        <label class="checkbox-inline">
            <input type="checkbox" value="" @if(getResult(lab_type(),$application->lab_type)=="srdl")checked @endif disabled>শেখ রাসেল ডিজিটাল ল্যাব
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" value=""  @if(getResult(lab_type(),$application->lab_type)=="sof")checked @endif disabled>স্কুল অফ ফিউচার
        </label>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <h4 class="callout callout-info">শিক্ষা প্রতিষ্ঠানের বিবরণ</h4>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('ins_bn', 'শিক্ষা প্রতিষ্ঠানের নাম:') }}
        {{ $application->institution_bn }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('is_institution_bn_correction_needed', 'সংশোধিত শিক্ষা প্রতিষ্ঠানের নাম:') }}
        {{ $application->profile->institution_corrected??"" }}
    </div>
</div>
<div class="form-row">
    <div class="form-group" >
        {{ Form::label('ins_en', 'শিক্ষা প্রতিষ্ঠানের নাম (ENGLISH):') }}
        {{ $application->profile->institution ?? "" }}
    </div>
</div>

<div class="form-row">
    @if($application->lab_type==lab_type()['srdl'])
    <div class="form-group col-md-6">
        <label for="">প্রতিষ্ঠানের ধরন</label>
            @foreach($ins_type as $instyp)
            <label class="checkbox-inline">
                <input type="checkbox" value=""  @if($application->institution_type ==$instyp)checked @endif disabled>{{$instyp}}
            </label>
            @endforeach
    </div>
    <div class="form-group col-md-6">
        <label for="">প্রতিষ্ঠানের স্তর</label>
            @if($application->institution_type== ins_type()['technical'])
                    @foreach($ins_level_technical as $inslvl)
                        <label class="checkbox-inline">
                            <input type="checkbox" value=""  @if($application->institution_level ==$inslvl)checked @endif disabled>{{$inslvl}}
                        </label>
                    @endforeach
            @else
                    @foreach($ins_level as $inslvl)
                        <label class="checkbox-inline">
                            <input type="checkbox" value=""  @if($application->institution_level ==$inslvl)checked @endif disabled>{{$inslvl}}
                        </label>
                    @endforeach
            @endif
    </div>
    @else
        <div class="form-group col-md-6">
            <label for="">প্রতিষ্ঠানের ধরন</label>
        @foreach($ins_type_sof as $instyp)
                <label class="checkbox-inline">
                    <input type="checkbox" value=""  @if($application->institution_type ==$instyp)checked @endif disabled>{{$instyp}}
                </label>
        @endforeach
        </div>
        <div class="form-group col-md-6">
            <label for="">প্রতিষ্ঠানের স্তর</label>
            @foreach($ins_level_sof as $inslvl)
                <label class="checkbox-inline">
                    <input type="checkbox" value=""  @if($application->institution_level ==$inslvl)checked @endif disabled>{{$inslvl}}
                </label>
            @endforeach
        </div>
    @endif
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">EIIN নম্বর:</label>
        {{$application->profile->eiin ?? ""}}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('mpo', 'MPO কোড:') }}
        {{$application->profile->mpo ?? ""}}
    </div>
</div>

<div class="form-row">
    <div class="form-group  col-md-6">
        {{ Form::label('total_boys', 'মোট ছাত্র:') }}
        {{$application->profile->total_boys ?? 0}}
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('total_girls', 'মোট ছাত্রী:') }}
        {{$application->profile->total_girls ?? 0}}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">প্রতিষ্ঠান প্রধানের নাম:</label>
        {{$application->profile->head_name ?? ""}}
        <p>
            <label for="">প্রতিষ্ঠানের ইমেইল:</label>
            {{ $application->profile->institution_email ?? "" }}
        </p>
        <p>
            <label for="">প্রতিষ্ঠানের মোবাইল নম্বর:</label>
            {{ $application->profile->institution_tel ?? "" }}
        </p>
    </div>
    <div class="form-group col-md-6">
        <label for="">বিকল্প প্রতিষ্ঠান প্রতিনিধি/কমিটির সভাপতির নাম:</label>
        {{ $application->profile->alt_name ?? "" }}
        <p>
            <label for="">ইমেইল:</label>
            {{ $application->profile->alt_email ?? "" }}
        </p>
        <p>
            <label for="">মোবাইল নম্বর:</label>
            {{ $application->profile->alt_tel ?? "" }}
        </p>
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-12">
        <h4 class="callout callout-danger">প্রতিষ্ঠানের ঠিকানা</h4>
    </div>
</div>

<div class="form-row">
    <div class="form-group  col-md-6">
        {{Form::label('dis', 'জেলা:') }}
        {{ $application->district??"" }}
    </div>
    <div class="form-group  col-md-6">
        {{Form::label('upazila', 'উপজেলা:') }}
        {{ $application->upazila??"" }}
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6">
        {{Form::label('union_pourashava_ward', 'ইউনিয়ন/পৌরসভা/ওয়ার্ড:') }}
        {{ $application->union_pourashava_ward?? "" }}
        @if(!empty($application->union_pourashava_ward)&& $application->union_pourashava_ward=="অন্যান্য" && !empty($application->profile->union_others) )@endif
        {{ $application->profile->union_others??"" }}
    </div>
    <div class="form-group  col-md-6">
        {{Form::label('ward', 'ওয়ার্ড নং:') }}
        {{$application->profile->ward??""}}
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6">
        {{Form::label('village_road', 'গ্রাম/পাড়া/মহল্লা/সড়ক:') }}
        {{$application->profile->village_road??""}}
    </div>
    <div class="form-group  col-md-3">
        {{Form::label('post_office', 'পোস্ট অফিস:') }}
        {{ $application->profile->post_office??""}}
    </div>
    <div class="form-group  col-md-3">
        {{Form::label('post_code', 'পোস্ট কোড:') }}
        {{$application->profile->post_code??""}}
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6">
        {{Form::label('distance_from_upazila_complex', 'উপজেলা পরিষদ হতে দূরত্ব (কিলোমিটার)') }}
        {{$application->profile->distance_from_upazila_complex??""}}
    </div>
    <div class="form-group  col-md-6">
        {{Form::label('proper_road', 'প্রতিষ্ঠানটি পর্যন্ত যান চলাচলের মতো রাস্তা আছে কিনা?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->profile->proper_road) && $application->profile->proper_road=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->profile->proper_road) ) checked @endif disabled>না
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6">
        {{Form::label('latitude', 'অক্ষাংশ (LATITUDE):') }}
        {{$application->profile->latitude??""}}
    </div>
    <div class="form-group  col-md-6">
        {{Form::label('longitude', 'দ্রাঘিমাংশ (LONGITUDE):') }}
        {{$application->profile->longitude??""}}
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6">
        {{Form::label('seat_no', 'সংসদীয় আসন নং:') }}
        {{ $application->seat_no??"" }}
    </div>
    <div class="form-group  col-md-6">
        {{Form::label('parliamentary_constituency', 'নির্বাচনী এলাকা') }}
        {{ $application->parliamentary_constituency??"" }}
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-12">
        <h4 class="callout callout-warning">উপযুক্ততা যাচাই</h4>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        {{ Form::label('having_labs', 'প্রতিষ্ঠানটিতে ইতোমধ্যে কোন কম্পিউটার ল্যাব প্রদান করা হয়েছে কিনা?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($selectedLabs)) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($selectedLabs)) checked @endif  disabled>না
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-8">
        <label for="">প্রাপ্ত সরকারি কম্পিউটার ল্যাব সমূহ (যদি থাকে):</label>
        @foreach($labs as $key=>$lab)
            <label class="checkbox-inline">
                <input type="checkbox" value=""  @if(in_array($key,$selectedLabs))checked @endif disabled>{{$lab}}
            </label>
        @endforeach
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('other_labs', 'অন্যান্য কম্পিউটার ল্যাব(যদি থাকে):') }}
        {{$application->lab->lab_others_title??""}}
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-8">
        {{ Form::label('proper_infrastructure', 'উপযুক্ত অবকাঠামো এবং আইসিটি শিক্ষার সুযোগ, সুবিধা আছে কিনা? ') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->proper_infrastructure) && $application->verification->proper_infrastructure=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->proper_infrastructure)) checked @endif  disabled>না
        </label>
    </div>
    <div class="form-group  col-md-4">
        {{ Form::label('electricity_solar', 'নিরবিচ্ছিন্ন বিদ্যুৎ/সোলার সরবরাহ আছে?                          ') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->electricity_solar) && $application->verification->electricity_solar=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->electricity_solar) ) checked @endif  disabled>না
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('internet_connection', 'ইন্টারনেট সংযোগ আছে ?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->internet_connection) && $application->verification->internet_connection=="YES" ) checked @endif disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->internet_connection)) checked @endif  disabled>না
        </label>
    </div>
    <div class="form-group col-md-6">
        {{Form::label('internet_connection_type', 'ইন্টারনেট সংযোগের ধরন ?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->internet_connection_type) && $application->verification->internet_connection_type=="modem")checked @endif disabled>মডেম
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->internet_connection_type) && $application->verification->internet_connection_type=="broadband")checked @endif disabled>ব্রডব্যান্ড
        </label>
    </div>
</div>
<div class="form-row ">
    <div class="form-group  col-md-6">
        {{ Form::label('good_result', 'প্রতিষ্ঠানটি ভালো ফলাফলকারী (বিশেষ করে ইংরেজি, গণিত এবং বিজ্ঞান বিষয়ে)?', array('class' => 'awesome')) }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->good_result) && $application->verification->good_result=="YES" ) checked @endif   disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->good_result)) checked @endif  disabled>না
        </label>
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('proper_room', 'অন্তত ১৭টি টেবিল ও ৩২জন ছাত্রের বসার মত সুপরিসর কক্ষ আছে?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->proper_room) && $application->verification->proper_room=="YES" ) checked @endif disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->proper_room) ) checked @endif disabled>না
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6">
        {{ Form::label('has_ict_teacher', 'আইসিটি শিক্ষক আছে ?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->has_ict_teacher) && $application->verification->has_ict_teacher=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->has_ict_teacher)  ) checked @endif  disabled>না
        </label>
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('proper_security', 'ল্যাবের নিরাপত্তার জন্য উপযুক্ত পরিবেশ আছে?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->proper_security) && $application->verification->proper_security=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->proper_security)) checked @endif  disabled>না
        </label>
    </div>
</div>

<div class="form-row">
    <div class="form-group  col-md-6">
        {{ Form::label('lab_maintenance', 'ল্যাবে সরবরাহকৃত আইটি ও অন্যান্য সরঞ্জামের রক্ষণাবেক্ষণ এবং ল্যাব পরিচালনা ও সংরক্ষণে প্রতিশ্ৰুতি সম্পন্ন শিক্ষা প্রতিষ্ঠান ?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->lab_maintenance) && $application->verification->lab_maintenance=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->lab_maintenance) ) checked @endif disabled>না
        </label>
    </div>
    <div class="form-group  col-md-6" >
        {{ Form::label('lab_prepared', 'ল্যাবের জন্য নির্ধারিত কক্ষটিতে যন্ত্রপাতি এবং আসবাবপত্র সরবরাহের পূর্বে ল্যাব কক্ষের সুরক্ষা ও নিরাপত্তা বৃদ্ধির জন্য উক্ত কক্ষের দরজা, জানালাসমূহ সুগঠিত রাখতে প্রস্তুত?') }}
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->lab_prepared) && $application->verification->lab_prepared=="YES" ) checked @endif disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->lab_prepared) ) checked @endif   disabled>না
        </label>
    </div>
</div>

<div class="form-row">
    <div class="form-group shadow-textarea col-md-12">
        <label class="awesome" for="about_institution">প্রতিষ্ঠানটি সম্পর্কে আপনার মন্তব্য</label>
        <textarea class="form-control z-depth-1" id="about_institution" name="about_institution" rows="5" placeholder="">{{ $application->verification->about_institution ?? "" }}</textarea>
    </div>
</div>
<div class="form-row">
    <div class="form-group  col-md-6 ">
        @if($application->lab_type== lab_type()['srdl'])
            {{ Form::label('upazila_verified','সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে শেখ রাসেল ডিজিটাল ল্যাব স্থাপনের জন্য সুপারিশ করা হল।',["id"=>"upazila_verified_lb"])}}
        @else
            {{ Form::label('upazila_verified','সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে স্কুল অফ ফিউচার স্থাপনের জন্য সুপারিশ করা হল।',["id"=>"upazila_verified_lb"])}}
        @endif
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->app_upazila_verified) && $application->verification->app_upazila_verified=="YES" ) checked @endif disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->app_upazila_verified)) checked @endif  disabled>না
        </label>
    </div>

    <div class="form-group  col-md-6 ">
        @if($application->lab_type== lab_type()['srdl'])
            {{ Form::label('district_verified', 'জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে শেখ রাসেল ডিজিটাল ল্যাব স্থাপন করা যেতে পারে।',["id"=>"district_verified_lb"])}}
        @else
            {{ Form::label('district_verified', 'জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে স্কুল অফ ফিউচার স্থাপন করা যেতে পারে।',["id"=>"district_verified_lb"])}}
        @endif
        <label class="checkbox-inline">
            <input type="checkbox" @if(!empty($application->verification->app_district_verified) && $application->verification->app_district_verified=="YES" ) checked @endif  disabled>হ্যাঁ
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" @if(empty($application->verification->app_district_verified)) checked @endif   disabled>না
        </label>
    </div>
</div>

@if(Auth::user()->hasRole(['super admin']))

    <div class="form-row">
        <div class="form-group col-md-12">
            <h4 class="callout callout-success">আবেদনের ধরণ (ডিও/ অন্যান্য সুপারিশ)</h4>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            {{ Form::label('listed_by_deo', 'আধা-সরকারি পত্রের (৪২৫/৪২৬) প্রেক্ষিতে তালিকা ভুক্ত?') }}
            <label class="checkbox-inline">
                <input type="checkbox" @if(!empty($application->listed_by_deo) && $application->listed_by_deo=="YES" ) checked @endif  disabled>হ্যাঁ
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" @if(!empty($application->listed_by_deo) && $application->listed_by_deo=="NO" ) checked @endif  disabled>না
            </label>
        </div>
    </div>
    @if($application->listed_by_deo=="YES")
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('member_name', 'মাননীয় সংসদ সদস্যের নাম') }}
            {{$application->attachment->member_name ?? ""}}
        </div>
        <div class="form-group col-md-6">
        {{ Form::label('list_attachment', 'প্রেরিত তালিকার স্ক্যান কপি (পিডিএফ):') }}
             @if(!empty($application->attachment->list_attachment_file))
                    <a href="{{ $application->attachment->list_attachment_file }}" target="_blank"> {{ $application->attachment->list_attachment_file_path_type }}</a>
            @elseif(!empty($listAttachmentFile))
                    <a href="{{ $listAttachmentFile }}" target="_blank"> {{ $listAttachmentFilePathType }}</a>
            @endif
        </div>
    </div>
    @endif
        <div class="form-row">
            <div class="form-group ">
                {{ Form::label('reference', 'সুপারিশ আছে?') }}
                <label class="checkbox-inline">
                    <input type="checkbox" @if($application->listed_by_deo=="NO" && !empty($application->attachment->ref_type) ) checked @endif  disabled>হ্যাঁ
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" @if($application->listed_by_deo=="YES" || empty($application->attachment->ref_type)) checked @endif  disabled>না
                </label>
            </div>
        </div>
        @if($application->listed_by_deo=="NO" && !empty($application->attachment->ref_type) )
        <div class="form-row ref">
            <div class="form-group col-md-6">
                {{ Form::label('ref_type', 'সুপারিশকারীর পরিচয়') }}
                {{ !empty($application->attachment->ref_type)?$application->attachment->ref_type:"" }}
            </div>
            <div class="form-group  col-md-6">
                {{ Form::label('ref_name', 'সুপারিশকারীর নাম') }}
                {{$application->attachment->ref_name ?? ''}}
            </div>
        </div>
        <div class="form-row ref">
            <div class="form-group  col-md-6">
                {{ Form::label('ref_designation', 'সুপারিশকারীর পদবী') }}
                {{ $application->attachment->ref_designation ?? '' }}
            </div>
            <div class="form-group  col-md-6">
                {{ Form::label('ref_office', 'সুপারিশকারীর কর্মস্থল') }}
                {{$application->attachment->ref_office ?? ''}}
            </div>
        </div>
        <div class="form-row ref">
            <div class="form-group">
            {{ Form::label('ref_documents', 'সুপারিশ সম্পর্কিত ডকুমেন্টস:') }}
            @if(!empty($application->attachment->ref_documents_file_path))
                <a href="{{ $application->attachment->ref_documents_file }}" target="_blank"> {{ $application->attachment->ref_documents_file_path_type }}</a>
            @endif
            </div>
        </div>
        @endif
    <div class="form-row verification_report_file" >
        <div class="form-group">
            {{ Form::label('verification_report_file', 'উপজেলা থেকে প্রেরিত প্রতিষ্ঠানটির পরিদর্শন প্রতিবেদনের স্ক্যান কপি (পিডিএফ):') }}
        @if(!empty($application->attachment->verification_report_file))
            <a href="{{ $application->attachment->verification_report_file }}" target="_blank"> {{ $application->attachment->verification_report_file_path_type }}</a>
        @endif
        </div>
    </div>
@endif
