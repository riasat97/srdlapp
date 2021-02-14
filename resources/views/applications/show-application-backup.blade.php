<div class="container">
    <div class="row">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="">
            <tbody>
            <tr class="">
                <td width="33.33%" height="100" align="left" valign="middle" class="text-center">
                    <img src="{{asset('images/Bangladesh-Govt-Logo.jpg')}}" alt="logo" class="img-responsive" style="height: 55px;padding-bottom: 0px; margin-bottom: 0px;">
                </td>
                <td width="33.33%" height="100" align="center" valign="middle" class="text-center">
                    <img src="{{asset('images/srdl-logo.jpg')}}" alt="logo" class="img-responsive" style="height: 55px;padding-bottom: 0px; margin-bottom: 0px;">
                </td>
                <td width="33.33%" height="100" align="right" valign="middle" class="text-center">
                    <img src="{{asset('images/Mujib Borsho.png')}}" alt="logo" class="img-responsive" style="height: 40px;">
                </td>
            </tr>
            </tbody>
        </table>



        {{--<div class="logo">--}}
        {{--<div class="left-logo" style="float: left; display: inline-block;">--}}
        {{--<img src="{{asset('images/digital-bd-logo.jpg')}}" alt="logo" class="img-responsive"  style="height: 40px; float: left;">--}}
        {{--<img src="{{asset('images/ictd-logo.jpg')}}" alt="logo" class="img-responsive" style="height: 40px; float: left;">--}}
        {{--<img src="{{asset('images/doict-logo.jpeg')}}" alt="logo" class="img-responsive" style="height: 40px; float: left;">--}}
        {{--<img src="{{asset('images/srdl-logo.jpg')}}" alt="logo" class="img-responsive" style="height: 50px; text-align: center; padding-left: 50px;">--}}
        {{--<img src="{{asset('images/Mujib Borsho.png')}}" alt="logo" class="img-responsive" style="height: 40px; float: right;">--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>


    <div class="row main-content" style="">
        <div class="heading">
            <h3 class="heading-text">
                প্রাথমিকভাবে শেখ রাসেল ডিজিটাল ল্যাব/ স্কুল অফ ফিউচারের উপযুক্ততা যাচাইয়ের জন্য শিক্ষা প্রতিষ্ঠান নির্বাচন সংশ্লিষ্ট প্রতিবেদন
            </h3>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table1">
            <tbody>
            <tr>
                <th colspan="2" class="block-heading">কম্পিউটার ল্যাবের ধরণ</th>
            </tr>

            <tr class="lab-type-box">
                <td width="50%" height="50" align="center" valign="middle" class="text-center">
                    @if(getResult(lab_type(),$application->lab_type)=="srdl")
                        <img src="{{asset('images/checkbox-checked.png')}}" alt="checked" style="height: 16px;"> শেখ রাসেল ডিজিটাল ল্যাব
                    @endif

                    @if(getResult(lab_type(),$application->lab_type)=="sof")
                        <img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> শেখ রাসেল ডিজিটাল ল্যাব
                    @endif
                </td>

                <td width="50%" height="50" align="center" valign="middle" class="text-center">
                    @if(getResult(lab_type(),$application->lab_type)=="sof")
                        <img src="{{asset('images/checkbox-checked.png')}}" alt="checked" style="height: 16px;"> স্কুল অফ ফিউচার
                    @endif

                    @if(getResult(lab_type(),$application->lab_type)=="srdl")
                        <img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> স্কুল অফ ফিউচার
                    @endif
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table1 table2">
            <tbody>
            <tr>
                <th colspan="3" class="block-heading">শিক্ষা প্রতিষ্ঠানের বিবরণ</th>
            </tr>

            <tr class="td-box">
                <td width="35%" height="35" align="left" valign="middle" class="padding010 border-right">
                    SRDL কোড:
                </td>

                <td colspan="2" width="65%" height="30" align="left" valign="middle" class="padding010">
                    {{ $application->id }}
                </td>
            </tr>

            <tr class="td-box">
                <td width="35%" height="30" align="left" valign="middle" class="padding010 border-right">
                    প্রতিষ্ঠানের নাম (বাংলায়):
                </td>

                <td colspan="2" width="65%" height="30" align="left" valign="middle" class="padding010">
                    {{ $application->institution_bn }}
                </td>
            </tr>

            <tr class="td-box">
                <td width="35%" height="30" align="left" valign="middle" class="padding010 border-right">
                    প্রতিষ্ঠানের নাম (ইংরেজিতে):
                </td>

                <td colspan="2" width="65%" height="30" align="left" valign="middle" class="padding010">
                    {{ $application->profile->institution ?? "" }}
                </td>
            </tr>

            <tr class="td-box">
                <td width="35%" height="30" align="left" valign="middle" class="padding010 border-right">
                    সংশোধনকৃত প্রতিষ্ঠানটির নাম (যদি থাকে):
                </td>

                <td colspan="2" width="65%" height="30" align="left" valign="middle" class="padding010">
                    {{ $application->profile->institution_corrected??"" }}
                </td>
            </tr>

            {{--<tr class="lab-type-box">--}}
            {{--<td width="40%" height="30" align="left" valign="middle" class="padding010 border-right">--}}
            {{--ম্যানেজমেন্ট:--}}
            {{--</td>--}}

            {{--<td width="30%" height="30" align="center" valign="middle" class="text-center padding010">--}}
            {{--<img src="{{asset('images/checkbox-checked.png')}}" alt="checked" style="height: 16px;"> সরকারি--}}
            {{--</td>--}}

            {{--<td width="30%" height="30" align="center" valign="middle" class="text-center padding010">--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> বেসরকারি--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<div class="form-row">--}}
            {{--<div class="form-group col-md-6">--}}
            {{--{{ Form::label('management', 'ম্যানেজমেন্ট:') }}--}}
            {{--<label class="checkbox-inline">--}}
            {{--<input type="checkbox" value="" @if(!empty($application->profile->management)&& $application->profile->management=="public")checked @endif disabled>সরকারি--}}
            {{--</label>--}}
            {{--<label class="checkbox-inline">--}}
            {{--<input type="checkbox" value=""  @if(!empty($application->profile->management)&& $application->profile->management=="private")checked @endif disabled>বেসরকারি--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</div>--}}


            {{--<tr class="lab-type-box">--}}
            {{--<td width="35%" height="30" align="left" valign="middle" class="padding5_10 border-right">--}}
            {{--প্রতিষ্ঠানের ধরন:--}}
            {{--</td>--}}

            {{--<td colspan="2" width="80%" height="30" align="left" valign="middle" class="padding5_10">--}}
            {{--<img src="{{asset('images/checkbox-checked.png')}}" alt="checked" style="height: 16px;"> সাধারণ--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> মাদ্রাসা--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> টেকনিক্যাল--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> সরকারি ট্রেনিং সেন্টার--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> শিক্ষা সংশ্লিষ্ট সরকারি প্রতিষ্ঠান--}}
            {{--</td>--}}
            {{--</tr>--}}



            {{--<tr class="lab-type-box">--}}
            {{--<td width="35%" height="30" align="left" valign="middle" class="padding5_10 border-right">--}}
            {{--প্রতিষ্ঠানের স্তর:--}}
            {{--</td>--}}

            {{--<td colspan="2" width="65%" height="30" align="left" valign="middle" class="padding5_10">--}}
            {{--<img src="{{asset('images/checkbox-checked.png')}}" alt="checked" style="height: 16px;"> প্রাইমারি বা সমপর্যায়--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> নিম্ন মাধ্যমিক বা সমপর্যায়--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> মাধ্যমিক বা সমপর্যায়--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> উচ্চমাধ্যমিক বা সমপর্যায়--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> মাধ্যমিক ও উচ্চমাধ্যমিক বা সমপর্যায়--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> স্নাতক বা সমপর্যায়--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> ডিপ্লোমা--}}
            {{--<img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> অন্যান্য--}}
            {{--</td>--}}
            {{--</tr>--}}
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="lab-type-box">
                <td width="20%" height="30" align="left" valign="middle" class="padding010 border-right">
                    ম্যানেজমেন্ট:
                </td>


                <td width="40%" height="30" align="center" valign="middle" class="text-center padding010">
                    <img @if(!empty($application->profile->management)&& $application->profile->management=="public")src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> সরকারি
                </td>

                <td width="40%" height="30" align="center" valign="middle" class="text-center padding010">
                    <img @if(!empty($application->profile->management)&& $application->profile->management=="private") src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> বেসরকারি
                </td>
                <td width="40%" height="30" align="center" valign="middle" class="text-center padding010">
                    <img @if(!empty($application->profile->management)&& $application->profile->management=="others") src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> অন্যান্য
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="lab-type-box">
                <td width="20%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    প্রতিষ্ঠানের ধরন:
                </td>

                <td width="80%" height="30" align="left" valign="middle" class="padding5_10">
                    @foreach($ins_type as $instyp)
                        <img @if($application->institution_type ==$instyp) src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif alt="checked" style="height: 16px;"> {{$instyp}}
                    @endforeach

                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="lab-type-box">
                <td width="20%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    প্রতিষ্ঠানের স্তর:
                </td>

                <td width="80%" height="30" align="left" valign="middle" class="padding5_10">
                    @if($application->institution_type== ins_type()['technical'])
                        @foreach($ins_level_technical as $inslvl)
                            <img @if($application->institution_level ==$inslvl) src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif alt="checked" style="height: 16px;"> {{$inslvl}}
                        @endforeach
                    @else
                        @foreach($ins_level as $inslvl)
                            <img @if($application->institution_level ==$inslvl) src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif alt="checked" style="height: 16px;">{{$inslvl}}
                        @endforeach
                    @endif
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding010 border-right">
                    EIIN (যদি থাকে): {{ $application->profile->eiin ?? ""}}
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding010">
                    MPO code (যদি থাকে): {{$application->profile->mpo ?? ""}}
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding010 border-right">
                    মোট ছাত্র: {{$application->profile->total_boys ?? ''}}
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding010">
                    মোট ছাত্রী: {{$application->profile->total_girls ?? ''}}
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    <p>প্রতিষ্ঠান প্রধানের নাম: {{$application->profile->head_name ?? ""}}</p>
                    <br><br>
                    <p>মোবাইল: {{ $application->profile->institution_email ?? "" }}</p>
                    <br>
                    <p>ইমেইল:{{ $application->profile->institution_tel ?? "" }}</p>
                    <br>
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding5_10">
                    <p>বিকল্প প্রতিনিধি/ কমিটির সভাপতির নাম: {{ $application->profile->alt_name ?? "" }}</p>
                    <br><br>
                    <p>মোবাইল: {{ $application->profile->alt_email ?? "" }}</p>
                    <br>
                    <p>ইমেইল: {{ $application->profile->alt_tel ?? "" }}</p>
                    <br>
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr>
                <th colspan="2" class="block-heading">প্রতিষ্ঠানের ঠিকানা</th>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>জেলা:	{{ $application->district??"" }}</p>
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding010">
                    <p>উপজেলা/সিটি কর্পোরেশন: {{ $application->upazila??"" }}</p>
                </td>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>
                        ইউনিয়ন/পৌরসভা:
                        {{ $application->union_pourashava_ward?? "" }}
                        @if(!empty($application->union_pourashava_ward)&& $application->union_pourashava_ward=="অন্যান্য" && !empty($application->profile->union_others) )@endif
                        {{ $application->profile->union_others??"" }}
                    </p>
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding010">
                    <p>ওয়ার্ড নং: {{$application->profile->ward??""}}</p>
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="45%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>গ্রাম/পাড়া/মহল্লা/সড়ক: {{$application->profile->village_road??""}}</p>
                </td>

                <td width="35%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>পোস্ট অফিস: {{ $application->profile->post_office??""}}</p>
                </td>

                <td width="20%" height="30" align="left" valign="middle" class="padding010">
                    <p>পোস্ট কোড: {{$application->profile->post_code??""}}</p>
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="45%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>উপজেলা পরিষদ হতে দূরত্ব (কিলোমিটার): {{$application->profile->distance_from_upazila_complex??""}}</p>
                </td>

                <td width="55%" height="30" align="left" valign="middle" class="padding010 border-right">
                    প্রতিষ্ঠানটি পর্যন্ত যান চলাচলের মতো রাস্তা আছে কিনা?
                    <img @if(!empty($application->profile->proper_road) && $application->profile->proper_road=="YES" ) src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty(!empty($application->profile->proper_road) && $application->profile->proper_road=="NO" )  ) src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>অক্ষাংশ (LATITUDE): {{$application->profile->latitude??""}}</p>
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding010">
                    <p>দ্রাঘিমাংশ (LONGITUDE): {{$application->profile->longitude??""}}</p>
                </td>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding010 border-right">
                    <p>সংসদীয় আসন নং: {{ $application->seat_no??"" }}</p>
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding010">
                    <p>নির্বাচনী এলাকা: {{ $application->parliamentary_constituency??"" }}</p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <br><br><br><br><br><br>

    <div class="row main-content" style="">
        {{--hhhhhhh--}}
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr>
                <th colspan="2" class="block-heading">উপযুক্ততা যাচাই</th>
            </tr>

            <tr class="td-box">
                <td colspan="2" width="100%" height="30" align="left" valign="middle" class="padding5_10">
                    শিক্ষা প্রতিষ্ঠানে ইতোমধ্যে কোন কম্পিউটার ল্যাব প্রদান করা হয়েছে কিনা?
                    <img @if(!empty($selectedLabs)) src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->govlab) && $application->verification->govlab=="NO") src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>
            </tr>

            <tr class="td-box">
                <td colspan="2" width="100%" height="30" align="left" valign="middle" class="padding5_10">
                    প্রাপ্ত সরকারি কম্পিউটার ল্যাব সমূহ (যদি থাকে):
                    @foreach($labs as $key=>$lab)
                        <img @if(in_array($key,$selectedLabs))src="{{asset('images/checkbox-checked.png')}}" @else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> {{$lab}}
                    @endforeach
                </td>
            </tr>

            <tr class="td-box">
                <td colspan="2" width="100%" height="30" align="left" valign="middle" class="padding5_10">
                    অন্যান্য কম্পিউটার ল্যাব(যদি থাকে): {{$application->lab->lab_others_title??""}}

                </td>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    উপযুক্ত অবকাঠামো (পাঁকা ভবন) এবং আইসিটি শিক্ষার সুযোগ, সুবিধা আছে কিনা?
                    <img @if(!empty($application->verification->proper_infrastructure) && $application->verification->proper_infrastructure=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->proper_infrastructure) && $application->verification->proper_infrastructure=="NO") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding5_10">
                    প্রতিষ্ঠানে নিরবিচ্ছিন্ন বিদ্যুৎ সরবরাহ আছে কিনা?
                    <img @if(!empty($application->verification->electricity_solar) && $application->verification->electricity_solar=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->electricity_solar) && $application->verification->electricity_solar=="NO") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    ইন্টারনেট সংযোগের ধরন?
                    <img @if(!empty($application->internet->internet_connection=="NO"))  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> নাই
                    <img @if(!empty($application->internet->internet_connection=="YES") && $application->internet->modem=="YES")  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> মডেম
                    <img @if(!empty($application->internet->internet_connection=="YES") && $application->internet->broadband=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> ব্রডব্যান্ড
                </td>
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    ডাটা কানেকশনের জন্য ব্যবহৃত মোবাইল অপারেটরসমূহ (যদি মডেম নির্বাচিত করে থাকেন):
                    <img @if(!empty($application->internet->modem=="YES") && $application->internet->gp=="YES")  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> গ্রামীনফোন
                    <img @if(!empty($application->internet->modem=="YES") && $application->internet->robi=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> রবি
                    <img @if(!empty($application->internet->modem=="YES") && $application->internet->banglalink=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> বাংলালিংক
                    <img @if(!empty($application->internet->modem=="YES") && $application->internet->airtel=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> এয়ারটেল
                    <img @if(!empty($application->internet->modem=="YES") && $application->internet->teletalk=="YES") src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> টেলিটক
                </td>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    প্রতিষ্ঠানটি ভালো ফলাফলধারী (বিশেষ করে ইংরেজি, গণিত এবং বিজ্ঞান বিষয়ে) কিনা?
                    <img @if(!empty($application->verification->good_result) && $application->verification->good_result=="YES" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->good_result) && $application->verification->good_result=="NO" ) src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding5_10">
                    ল্যাবের জন্য নির্বাচিত কক্ষটিতে অন্তত ১৭টি টেবিল ও ৩২ জন ছাত্রের স্বাচ্ছন্দ্যে বসার মত সুপরিসর কক্ষ আছে কিনা?
                    <img @if(!empty($application->verification->proper_room) && $application->verification->proper_room=="YES" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->proper_room) && $application->verification->proper_room=="NO" ) src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>
            </tr>

            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    প্রতিষ্ঠানে আইসিটি শিক্ষাদানের সক্ষমতা সম্পন্ন উপযুক্ত পর্যাপ্ত শিক্ষক আছে কিনা?
                    <img @if(!empty($application->verification->has_ict_teacher) && $application->verification->has_ict_teacher=="YES" ) src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->has_ict_teacher) && $application->verification->has_ict_teacher=="NO" ) src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding5_10">
                    ল্যাবের নিরাপত্তার জন্য উপযুক্ত পরিবেশ আছে?
                    <img @if(!empty($application->verification->proper_security) && $application->verification->proper_security=="YES" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->proper_security) && $application->verification->proper_security=="NO" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>
            </tr>


            <tr class="td-box">
                <td width="50%" height="30" align="left" valign="middle" class="padding5_10 border-right">
                    ল্যাবে সরবরাহকৃত আইটি ও অন্যান্য সরঞ্জামের রক্ষণাবেক্ষণ এবং ল্যাব পরিচালনা, সংরক্ষণে মানসিকতা ও প্রতিশ্ৰুতি সম্পন্ন কিনা?
                    <img @if(!empty($application->verification->lab_maintenance) && $application->verification->lab_maintenance=="YES" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->lab_maintenance) && $application->verification->lab_maintenance=="NO" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>

                <td width="50%" height="30" align="left" valign="middle" class="padding5_10">
                    ল্যাবের জন্য নির্ধারিত কক্ষটিতে যন্ত্রপাতি এবং আসবাবপত্র সরবরাহের পূর্বে ল্যাব কক্ষের সুরক্ষা ও নিরাপত্তা বৃদ্ধির জন্য উক্ত কক্ষের দরজা, জানালাসমূহ সুগঠিত রাখতে প্রস্তুত কিনা?
                    <img @if(!empty($application->verification->lab_prepared) && $application->verification->lab_prepared=="YES" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                    <img @if(!empty($application->verification->lab_prepared) && $application->verification->lab_prepared=="NO" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                </td>
            </tr>
            </tbody>
        </table>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
            <tbody>
            <tr class="td-box">
                <td width="25%" height="100" align="left" valign="middle" class="padding5_10 border-right">
                    <p>প্রতিষ্ঠানটি সম্পর্কে সার্বিক মন্তব্য (যদি থাকে):  </p>
                </td>

                <td width="75%" height="100" align="left" valign="middle" class="padding5_10">
                    <p>{{ $application->verification->about_institution ?? "" }}</p>
                </td>
            </tr>
            </tbody>
        </table>
        @if((Auth::user()->hasRole(['upazila admin']) && !$districtVerified ) or Auth::user()->hasRole(['super admin']) )
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
                <tbody>
                <tr class="td-box">
                    <td width="50%" height="100" align="left" valign="middle" class="padding5_10 border-right">
                        <p>যাচাইকারী (উপজেলা মাধ্যমিক শিক্ষা অফিসার)  </p>
                        <br>
                        <p>স্বাক্ষর:  </p>
                        <br>
                        <p>সিল:   </p>
                        <br><br><br><br>
                    </td>

                    <td width="50%" height="100" align="left" valign="middle" class="padding5_10">
                        <p>যাচাইকারী (সহকারী প্রোগ্রামার)  </p>
                        <br>
                        <p>স্বাক্ষর:  </p>
                        <br>
                        <p>সিল:   </p>
                        <br><br><br><br>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table3">
                <tbody>
                <tr class="td-box">
                    <td width="50%" height="100" align="left" valign="middle" class="padding5_10 border-right">
                        <p>
                            @if($application->lab_type== lab_type()['srdl'])
                                {{ Form::label('upazila_verified','সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে শেখ রাসেল ডিজিটাল ল্যাব স্থাপনের জন্য:',["id"=>"upazila_verified_lb"])}}
                            @else
                                {{ Form::label('upazila_verified','সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে স্কুল অফ ফিউচার স্থাপনের জন্য:',["id"=>"upazila_verified_lb"])}}
                            @endif
                            {{--সুপারিশকারী (উপজেলা নির্বাহী অফিসার): যাচাইকারী কর্মকর্তার প্রতিবেদন মোতাবেক প্রতিষ্ঠান নির্বাচনের নির্দেশিকা অনুসরণ পূর্বক উক্ত প্রতিষ্ঠানে
                            <img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> শেখ রাসেল ডিজিটাল ল্যাব /
                            <img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> স্কুল অফ ফিউচার
                            স্থাপনের জন্য সুপারিশ করা হল:--}}
                            <img @if(!empty($application->verification->app_upazila_verified) && $application->verification->app_upazila_verified=="YES" ) src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                            <img @if(!empty($application->verification->app_upazila_verified) && $application->verification->app_upazila_verified=="NO" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                        </p>
                        <br>
                        <p>স্বাক্ষর:  </p>
                        <br>
                        <p>সিল:   </p>
                        <br><br><br><br>
                    </td>

                    <td width="50%" height="100" align="left" valign="middle" class="padding5_10">
                        <p>
                            @if($application->lab_type== lab_type()['srdl'])
                                {{ Form::label('district_verified', 'জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে শেখ রাসেল ডিজিটাল ল্যাব:',["id"=>"district_verified_lb"])}}
                            @else
                                {{ Form::label('district_verified', 'জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে স্কুল অফ ফিউচার:',["id"=>"district_verified_lb"])}}
                            @endif
                            {{--জেলা প্রশাসক: উপজেলা নির্বাহী অফিসারের সুপারিশমতে উক্ত প্রতিষ্ঠানে
                            <img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> শেখ রাসেল ডিজিটাল ল্যাব /
                            <img src="{{asset('images/empty-check-box.png')}}" alt="checked" style="height: 16px;"> স্কুল অফ ফিউচার
                            স্থাপন করা যেতে পারে:--}}
                            <img @if(!empty($application->verification->app_district_verified) && $application->verification->app_district_verified=="YES" )  src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> হ্যাঁ
                            <img @if(!empty($application->verification->app_district_verified) && $application->verification->app_district_verified=="NO" )   src="{{asset('images/checkbox-checked.png')}}"@else src="{{asset('images/empty-check-box.png')}}" @endif  alt="checked" style="height: 16px;"> না
                        </p>
                        <br>
                        <p>স্বাক্ষর:  </p>
                        <br>
                        <p>সিল:   </p>
                        <br><br><br><br>
                    </td>
                </tr>
                </tbody>
            </table>
        @endif
    </div>

    <div class="row qr-code">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="">
            <tbody>
            <tr class="">
                <td width="100%" height="100" align="center" valign="middle" class="text-center">
                    {{-- <img src="{{asset('images/qr-sample.png')}}" alt="logo" class="img-responsive" style="height: 100px;">--}}
                    {{-- <img src="data:image/png;base64, {!! base64_encode(\QrCode::format('png')->merge('images/srdl.png', 0.3, true)
                     ->size(100)->errorCorrection('H')
                     ->generate(route('applications.show',$application->id ))) !!} ">--}}
                    {{-- {{ \QrCode::format('png')->merge('images/qr.png', 0.3,true)->generate(route('applications.show',$application->id )) }}--}}
                    <img src="{{asset('images/qr.png')}}" alt="logo" class="img-responsive" style="height: 100px;">

                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row footer">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="">
            <tbody>
            <tr class="">
                <td width="33.33%" height="70" align="center" valign="middle" class="text-center">
                    <img src="{{asset('images/ictd-logo.jpg')}}" alt="logo" class="img-responsive" style="height: 55px; float: left;">
                </td>
                <td width="33.33%" height="70" align="center" valign="middle" class="text-center">
                    <img src="{{asset('images/digital-bd-logo.jpg')}}" alt="logo" class="img-responsive"  style="height: 55px; float: left;">
                </td>
                <td width="33.33%" height="70" align="center" valign="middle" class="text-center">
                    <img src="{{asset('images/doict-logo.jpeg')}}" alt="logo" class="img-responsive" style="height: 55px; float: left;">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

