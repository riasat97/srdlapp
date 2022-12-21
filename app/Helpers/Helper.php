<?php

use App\Models\Bangladesh;
use Illuminate\Support\Facades\Auth;

if (!function_exists('ReservedSeats')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function getResult(array $arr,$res){
        $input = array_flip($arr);
        return $input[$res];
    }
    function lab_type(){
        return array('srdl'=>'শেখ রাসেল ডিজিটাল ল্যাব','sof' => 'স্কুল অফ ফিউচার','srdl_sof'=>'স্কুল অফ ফিউচার ও শেখ রাসেল ডিজিটাল ল্যাব');
    }
    function management(){
        return array('public'=>'সরকারি','private' => 'বেসরকারি','others'=>'অন্যান্য');
    }
    function institution_type(){
        return array('school' => 'স্কুল', 'college' => 'কলেজ', 'school and college'=> "স্কুল ও কলেজ", 'madrasha'=> "মাদ্রাসা",'technical'=>"টেকনিক্যাল",'primary'=>'প্রাইমারি','university'=>'বিশ্ববিদ্যালয়','gov_training'=>"সরকারি ট্রেনিং সেন্টার",'gov_rel_ins'=>"শিক্ষা সংশ্লিষ্ট সরকারি প্রতিষ্ঠান",'others'=>"অন্যান্য");
    }
    function ins_type(){
        return array(""=>"",'general'=> "সাধারণ", 'madrasha'=> "মাদ্রাসা",'technical'=>"টেকনিক্যাল",'gov_training'=>"সরকারি ট্রেনিং সেন্টার",'gov_rel_ins'=>"শিক্ষা সংশ্লিষ্ট সরকারি প্রতিষ্ঠান",'others'=>"অন্যান্য");
    }
    function ins_level(){
        return array(""=>"",'primary'=>'প্রাইমারি বা সমপর্যায়','junior_secondary' => 'নিম্ন মাধ্যমিক বা সমপর্যায়', 'secondary' => 'মাধ্যমিক বা সমপর্যায়','higher_secondary'=> "উচ্চমাধ্যমিক বা সমপর্যায়", "secondary_and_higher"=>"মাধ্যমিক ও উচ্চমাধ্যমিক বা সমপর্যায়","graduation"=>"স্নাতক বা সমপর্যায়","post_graduation"=>"স্নাতকোত্তর","diploma"=>"ডিপ্লোমা বা সমপর্যায়",'others'=>"অন্যান্য");
    }
    function ref_type(){
        return array('0' => 'নির্বাচন করুন','public_representative' => 'মাননীয় সংসদ সদস্য','political_party'=>'রাজনৈতিক দল', 'gov_emp' => 'সরকারি কর্মকর্তা',"famous_person"=>"প্রখ্যাত ব্যক্তিত্ব","others"=>"অন্যান্য ");
    }
    function internet_connection_types(){
        return array('0' => 'নাই','modem' => 'মডেম', 'broadband' => 'ব্রডব্যান্ড');
    }
    function mobile_operators(){
        return ['gp'=>'গ্রামীনফোন','robi'=>'রবি','banglalink'=>'বাংলালিংক','airtel'=>'এয়ারটেল','teletalk'=>'টেলিটক'];
    }
    function designations(){
        return array('0' => 'নির্বাচন করুন','dc' => 'জেলা প্রশাসক', 'adc' => 'অতিরিক্ত জেলা প্রশাসক','uno'=>'উপজেলা নির্বাহী অফিসার'/*,'programmer'=>'প্রোগ্রামার','ap'=>'সহকারী প্রোগ্রামার','useo'=>'উপজেলা মাধ্যমিক শিক্ষা অফিসার','others'=>'অন্যান্য'*/);
    }
    function trainee_designations(){
        return array('0' => 'নির্বাচন করুন', 'principal'=>'অধ্যক্ষ/প্রধান শিক্ষক','vice principal'=>'উপাধ্যক্ষ/সহকারী প্রধান শিক্ষক',
            'assistant professor'=>'সহকারী অধ্যাপক','senior_lecturer'=>'জ্যেষ্ঠ প্রভাষক','lecturer'=>'প্রভাষক','physical_education_teacher'=>'শরীরচর্চা শিক্ষক','demonstrator'=>'প্রদর্শক','librarian'=>'গ্রন্থাগারিক',
            'chief_instructor'=>'চীফ ইন্সট্রাক্টর','superintendent'=>'সুপারিনটেনডেন্ট','assistant_superintendent'=>'সহকারী সুপারিনটেনডেন্ট','senior_instructor'=>'সিনিয়র ইন্সট্রাক্টর','trade_instructor'=>'ট্রেড ইন্সট্রাক্টর','instructor'=>'ইন্সট্রাক্টর',
            'senior_assistant_teacher'=>'সিনিয়র সহকারী শিক্ষক','assistant_teacher'=>'সহকারী শিক্ষক','assistant_moulavi'=>'সহকারী মৌলভী','assistant_librarian'=>'সহকারী গ্রন্থাগারিক','junior_instructor'=>'জুনিয়র ইন্সট্রাক্টর','others'=>'অন্যান্য');
    }
    function qualifications(){
        return array('0' => 'নির্বাচন করুন','m.eng'=>"M.Sc (Engineering)",'msc'=>"M.Sc",'kamil'=>"Kamil","llm"=>"LL.M",'ma'=>"M.A","mcom"=>"M.Com","med"=>"M.Ed","mss"=>"M.S.S","mba"=>"MBA","mbs"=>"MBS","me/mtech"=>"ME/Mtech","mmed"=>"Mmed","bsc.eng"=>"B.Sc (Engineering)",'bsc'=>"B.Sc (Honors)","ba"=>"B.A","bcom"=>"B.Com","bed"=>"B.Ed","bss"=>"B.S.S","btech"=>"B.Tech","bba"=>"BBA","bbs"=>"BBS","fazil"=>"Fazil","llb"=>"LL.B","others"=>"Others");
    }
    function ages(){
        $ages=[];
        for($i=21;$i<60;$i++){
            $ages[$i]=$i;
        }
        return array_merge(['-1' => 'নির্বাচন করুন'],$ages);
    }
    function phase(){
        return [1=>'১ম',2=>'২য়'];
    }
    function ReservedSeats()
    {
        return $reservedSeats=array(
            0 => array('seat_no_en' => '301', 'seat_no' => '৩০১', 'parliamentary_constituency' => 'মহিলা আসন-১'),
            1 => array('seat_no_en' => '302', 'seat_no' => '৩০২', 'parliamentary_constituency' => 'মহিলা আসন-২'),
            2 => array('seat_no_en' => '303', 'seat_no' => '৩০৩', 'parliamentary_constituency' => 'মহিলা আসন-৩'),
            3 => array('seat_no_en' => '304', 'seat_no' => '৩০৪', 'parliamentary_constituency' => 'মহিলা আসন-৪'),
            4 => array('seat_no_en' => '305', 'seat_no' => '৩০৫', 'parliamentary_constituency' => 'মহিলা আসন-৫'),
            5 => array('seat_no_en' => '306', 'seat_no' => '৩০৬', 'parliamentary_constituency' => 'মহিলা আসন-৬'),
            6 => array('seat_no_en' => '307', 'seat_no' => '৩০৭', 'parliamentary_constituency' => 'মহিলা আসন-৭'),
            7 => array('seat_no_en' => '308', 'seat_no' => '৩০৮', 'parliamentary_constituency' => 'মহিলা আসন-৮'),
            8 => array('seat_no_en' => '309', 'seat_no' => '৩০৯', 'parliamentary_constituency' => 'মহিলা আসন-৯'),
            9 => array('seat_no_en' => '310', 'seat_no' => '৩১০', 'parliamentary_constituency' => 'মহিলা আসন-১০'),
            10 => array('seat_no_en' => '311', 'seat_no' => '৩১১', 'parliamentary_constituency' => 'মহিলা আসন-১১'),
            11 => array('seat_no_en' => '312', 'seat_no' => '৩১২', 'parliamentary_constituency' => 'মহিলা আসন-১২'),
            12 => array('seat_no_en' => '313', 'seat_no' => '৩১৩', 'parliamentary_constituency' => 'মহিলা আসন-১৩'),
            13 => array('seat_no_en' => '314', 'seat_no' => '৩১৪', 'parliamentary_constituency' => 'মহিলা আসন-১৪'),
            14 => array('seat_no_en' => '315', 'seat_no' => '৩১৫', 'parliamentary_constituency' => 'মহিলা আসন-১৫'),
            15 => array('seat_no_en' => '316', 'seat_no' => '৩১৬', 'parliamentary_constituency' => 'মহিলা আসন-১৬'),
            16 => array('seat_no_en' => '317', 'seat_no' => '৩১৭', 'parliamentary_constituency' => 'মহিলা আসন-১৭'),
            17 => array('seat_no_en' => '318', 'seat_no' => '৩১৮', 'parliamentary_constituency' => 'মহিলা আসন-১৮'),
            18 => array('seat_no_en' => '319', 'seat_no' => '৩১৯', 'parliamentary_constituency' => 'মহিলা আসন-১৯'),
            19 => array('seat_no_en' => '320', 'seat_no' => '৩২০', 'parliamentary_constituency' => 'মহিলা আসন-২০'),
            20 => array('seat_no_en' => '321', 'seat_no' => '৩২১', 'parliamentary_constituency' => 'মহিলা আসন-২১'),
            21 => array('seat_no_en' => '322', 'seat_no' => '৩২২', 'parliamentary_constituency' => 'মহিলা আসন-২২'),
            22 => array('seat_no_en' => '323', 'seat_no' => '৩২৩', 'parliamentary_constituency' => 'মহিলা আসন-২৩'),
            23 => array('seat_no_en' => '324', 'seat_no' => '৩২৪', 'parliamentary_constituency' => 'মহিলা আসন-২৪'),
            24 => array('seat_no_en' => '325', 'seat_no' => '৩২৫', 'parliamentary_constituency' => 'মহিলা আসন-২৫'),
            25 => array('seat_no_en' => '326', 'seat_no' => '৩২৬', 'parliamentary_constituency' => 'মহিলা আসন-২৬'),
            26 => array('seat_no_en' => '327', 'seat_no' => '৩২৭', 'parliamentary_constituency' => 'মহিলা আসন-২৭'),
            27 => array('seat_no_en' => '328', 'seat_no' => '৩২৮', 'parliamentary_constituency' => 'মহিলা আসন-২৮'),
            28 => array('seat_no_en' => '329', 'seat_no' => '৩২৯', 'parliamentary_constituency' => 'মহিলা আসন-২৯'),
            29 => array('seat_no_en' => '330', 'seat_no' => '৩৩০', 'parliamentary_constituency' => 'মহিলা আসন-৩০'),
            30 => array('seat_no_en' => '331', 'seat_no' => '৩৩১', 'parliamentary_constituency' => 'মহিলা আসন-৩১'),
            31 => array('seat_no_en' => '332', 'seat_no' => '৩৩২', 'parliamentary_constituency' => 'মহিলা আসন-৩২'),
            32 => array('seat_no_en' => '333', 'seat_no' => '৩৩৩', 'parliamentary_constituency' => 'মহিলা আসন-৩৩'),
            33 => array('seat_no_en' => '334', 'seat_no' => '৩৩৪', 'parliamentary_constituency' => 'মহিলা আসন-৩৪'),
            34 => array('seat_no_en' => '335', 'seat_no' => '৩৩৫', 'parliamentary_constituency' => 'মহিলা আসন-৩৫'),
            35 => array('seat_no_en' => '336', 'seat_no' => '৩৩৬', 'parliamentary_constituency' => 'মহিলা আসন-৩৬'),
            36 => array('seat_no_en' => '337', 'seat_no' => '৩৩৭', 'parliamentary_constituency' => 'মহিলা আসন-৩৭'),
            37 => array('seat_no_en' => '338', 'seat_no' => '৩৩৮', 'parliamentary_constituency' => 'মহিলা আসন-৩৮'),
            38 => array('seat_no_en' => '339', 'seat_no' => '৩৩৯', 'parliamentary_constituency' => 'মহিলা আসন-৩৯'),
            39 => array('seat_no_en' => '340', 'seat_no' => '৩৪০', 'parliamentary_constituency' => 'মহিলা আসন-৪০'),
            40 => array('seat_no_en' => '341', 'seat_no' => '৩৪১', 'parliamentary_constituency' => 'মহিলা আসন-৪১'),
            41 => array('seat_no_en' => '342', 'seat_no' => '৩৪২', 'parliamentary_constituency' => 'মহিলা আসন-৪২'),
            42 => array('seat_no_en' => '343', 'seat_no' => '৩৪৩', 'parliamentary_constituency' => 'মহিলা আসন-৪৩'),
            43 => array('seat_no_en' => '344', 'seat_no' => '৩৪৪', 'parliamentary_constituency' => 'মহিলা আসন-৪৪'),
            44 => array('seat_no_en' => '345', 'seat_no' => '৩৪৫', 'parliamentary_constituency' => 'মহিলা আসন-৪৫'),
            45 => array('seat_no_en' => '346', 'seat_no' => '৩৪৬', 'parliamentary_constituency' => 'মহিলা আসন-৪৬'),
            46 => array('seat_no_en' => '347', 'seat_no' => '৩৪৭', 'parliamentary_constituency' => 'মহিলা আসন-৪৭'),
            47 => array('seat_no_en' => '348', 'seat_no' => '৩৪৮', 'parliamentary_constituency' => 'মহিলা আসন-৪৮'),
            48 => array('seat_no_en' => '349', 'seat_no' => '৩৪৯', 'parliamentary_constituency' => 'মহিলা আসন-৪৯'),
            49 => array('seat_no_en' => '350', 'seat_no' => '৩৫০', 'parliamentary_constituency' => 'মহিলা আসন-৫০'),
        );
    }
    function direction(){
        return ['-1' => 'নির্বাচন করুন','east'=>'পূর্ব','west'=>'পশ্চিম','north'=>'উত্তর','south'=>'দক্ষিণ','north_east'=>'উত্তর-পূর্ব','north_west'=>'উত্তর-পশ্চিম',
            'south_east'=>'দক্ষিণ-পূর্ব','south_west'=>'দক্ষিণ-পশ্চিম'];
    }
    function room_status(){
        return array('building'=>'পাকা','half_building' => 'সেমি পাকা','tin_shed'=>'টিন শেড');
    }
    function window_status(){
        return array('iron'=>'লোহার গ্রিল','wooden' => 'কাঁঠের গ্রিল');
    }
     function permitted($application)
    {
        $user=Auth::user();
        if($user->hasRole('super admin'))
            return true;
        if($user->hasRole('district admin')){
            $district_en=explode('_',$user->username)[0];
            $district_match=Bangladesh::where('district',$application->district)->first()->district_en;
            return ($district_en== strtolower($district_match))?true:false;
        }
        if($user->hasRole('upazila admin')){
            $upazila_en_domain=explode('_',$user->username)[0];
            $district_en=explode('_',$user->username)[1];

            $upazila_match=Bangladesh::where('district',$application->district)->where('upazila',$application->upazila)->first()->upazila_en_domain;
            $district_match=Bangladesh::where('district',$application->district)->first()->district_en;
            return ($upazila_en_domain==$upazila_match && $district_en==strtolower($district_match))?true:false;
        }
        return false;
    }

}
