<?php
namespace App\Http\Controllers;
use App\Models\User;
use Flash;
use App\DataTables\ApplicationsDataTable;
use App\Http\Requests\CreateApplicationRequest;
use App\Models\Application;
use App\Models\ApplicationAttachment;
use App\Models\ApplicationLab;
use App\Models\ApplicationProfile;
use App\Models\ApplicationVerification;
use App\Models\Banbeis;
use App\Models\Bangladesh;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{

    public function application(ApplicationsDataTable $dataTable,Request $request)
    {
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $parliamentaryConstituencyList= $this->getParliamentaryConstituency($request);
        return $dataTable->render('applications.application',['divisionList'=>$divisionList,'parliamentaryConstituencyList'=>$parliamentaryConstituencyList]);
    }
    public function index(Request $request)
    {
        ini_set("memory_limit", "-1");
        if(empty(Auth::user()->mobile)&& !Auth::user()->hasRole(['super admin'])){
            Flash::success('প্রাপ্ত ল্যাবের আবেদনসমূহ দেখার পূর্বে নিজ প্রোফাইল তৈরি করতে হবে।');
            return redirect(route('users.edit',['id'=>Auth::user()->id]));
        }
        if ($request->ajax()) {
            //dd($request->all());
            $data=$this->getAppData($request);
            $user= Auth::user();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)use ($user) {
                    //dd($row);
                    $btn="";
                    if( ($user->hasRole('district admin') && $user->verified!="YES")or $user->hasRole(['super admin'])){
                        $lb_status=(!empty($row->verification->app_district_verified))?'Verified':'Verify';
                        $label= $user->hasRole('super admin')?'Edit':$lb_status;
                    $btn="<a href='".route("applications.edit",$row->id)."' target=\"_blank\" class='super-admin-edit verify btn btn-info btn-sm'>$label</a> ";
                    }
//                    if (App::environment('local')) {
//                    $btn=$btn."<a href='javascript:void(0)' data-application='" . json_encode($row) . "' class='edit btn btn-success btn-sm'>Edit</a>";
//                    }
                    /*$btn=$btn." <a href='javascript:void(0)' data-id='" . $row->id . "' class='view btn btn-success btn-sm'>View</a>";*/
                    if(Auth::user()->hasRole(['super admin']))
                    $btn = $btn." <a href='javascript:void(0)' class='delete btn btn-warning btn-sm'>Details</a>";
                    if(($user->hasRole('district admin') && $user->verified!="YES")or $user->hasRole(['super admin']))
                    $btn=$btn." <a href='javascript:void(0)' data-id='" . $row->id . "' class='duplicate btn btn-danger btn-sm'>Duplicate</a>";
                    if(($user->hasRole('district admin') && $user->verified=="YES")or $user->hasRole(['super admin'])){
                        $btn=$btn." <a href='" .route('loadpdf',$row->id ). "' data-id='" . $row->id . "' target=\"_blank\" class='download btn btn-primary btn-sm'>View</a>";
                    }
                    if(($user->hasRole('district admin') && $user->verified=="NO")){
                        $btn=$btn." <a href='" .route('loadpdf',$row->id ). "' data-id='" . $row->id . "' target=\"_blank\" style=\"visibility: hidden\" class='viewForm btn btn-primary btn-sm'>View</a>";
                    }
                    if($user->hasRole('upazila admin')){
                        $label= $this->getDistrictVerificationStatus($user)?'View':'Download Form';
                        $btn=$btn." <a href='" .route('loadpdf',$row->id ). "' data-id='" . $row->id . "' target=\"_blank\" class='download btn btn-primary btn-sm'>$label</a>";
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $parliamentaryConstituencyList= $this->getParliamentaryConstituency($request);
        $upazilas= $this->getUpazilas($request);
        return view('applications.index',['divisionList'=>$divisionList,
            'parliamentaryConstituencyList'=>$parliamentaryConstituencyList,'upazilas'=>$upazilas]);
    }
    protected function getAppData(Request $request)
    {
        //dd(empty($request->get('upazilaId')));
        $data = Application::query();
        if (!empty($request->get('filter'))) {
            if (!empty($request->get('divId'))) {
                $data->where('division', $request->get('divId'));
            }

            if (!empty($request->get('disId'))) {
                $data->where('district', $request->get('disId'));
            }
            if (!empty($request->get('seat_type'))) {
                $seatType=$request->get('seat_type');
                if($seatType=="reserved")
                $data->whereLike('parliamentary_constituency', 'মহিলা আসন');
                else if ($seatType=="general")
                $data->whereNotLike('parliamentary_constituency', 'মহিলা আসন');
            }
            if (!empty($request->get('parliamentaryConstituencyId'))) {
                $data->where('parliamentary_constituency', $request->get('parliamentaryConstituencyId'));
            }
            if (!empty($request->get('upazilaId'))) {
                if(Auth::user()->hasRole('district admin') && $request->get('upazilaId')=='1')
                    $data->permitted(null);
                else
                $data->where('upazila', $request->get('upazilaId'));
            }
            if (!empty($request->get('unionPourashavaWardId'))) {
                $data->orWhere('union_pourashava_ward', $request->get('unionPourashavaWardId'));
            }
            if (!empty($request->get('lab_type'))) {
                $data->where('lab_type', $request->get('lab_type'));
            }
            if (!empty($request->get('application_type'))) {
                $applicationType= $request->get('application_type');
                if($applicationType=='listed_by_deo')
                $data->where('listed_by_deo', "YES");
                else if($applicationType=='ref')
                $data->where('listed_by_deo', "NO");
            }
            // dd($data->get()->toArray());
            return $data->with('attachment','verification')->orderByRaw(" division,district,seat_no asc, FIELD(lab_type , 'sof') DESC,upazila ASC")->get();
            //return $this->applyScopes($data);
        }
        return $data->with('attachment','verification')->permitted(null)->latest('id')->get();
        //return $this->applyScopes($data);
    }
    public function getParliamentaryConstituency(Request $request)
    {
        // dd($request->all());
        $user=Auth::user();
        if($user->hasRole(['district admin','upazila admin'])){
            $parliament = Bangladesh::permitted(null)
                ->groupBy('parliamentary_constituency')
                ->orderBy('seat_no_en','asc')
                ->pluck('parliamentary_constituency','parliamentary_constituency');
            $parliament=array_merge(['-1' => 'নির্বাচন করুন'], $parliament->toArray());
            return $parliament;
        }
        return [];
    }
    public function getUpazilas(Request $request)
    {
        // dd($request->all());
        $user=Auth::user();
        if($user->hasRole(['district admin'])){
            $upazilas = Bangladesh::permitted(null)
                ->groupBy('upazila')
                ->orderBy('upazila','asc')
                ->pluck('upazila','upazila');
            $select= ['1' => 'সকল'];
            $upazilas= $select+ $upazilas->toArray();
            return $upazilas;
        }
        return [];
    }

    public function  terms(){
        return view('applications.terms');
    }
    public function create(){

        if(!Auth::user()->hasRole(['super admin']))
             return abort(404);

        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $ins_type= array_merge(['-1' => 'নির্বাচন করুন'], Arr::except(ins_type(),[""]));
        $ins_level= array_merge(['-1' => 'নির্বাচন করুন'], Arr::only(ins_level(), array('primary','junior_secondary','secondary','higher_secondary','secondary_and_higher',"graduation","others")));
        $ins_type_sof= array_merge(['-1' => 'নির্বাচন করুন'], Arr::only($ins_type, array('general', 'madrasha', 'technical')));
        $ins_level_sof= $array = array_merge(['-1' => 'নির্বাচন করুন'],Arr::only(ins_level(), array('secondary', 'secondary_and_higher')));
        $ins_level_technical= $array = array_merge(['-1' => 'নির্বাচন করুন'],Arr::only(ins_level(), array('junior_secondary','secondary','higher_secondary','secondary_and_higher',"diploma","others")));
        return view('applications.create',['labs'=>$labs,'divisionList'=>$divisionList,
            "ins_type"=>$ins_type,"ins_level"=>$ins_level,"ins_type_sof"=>$ins_type_sof,"ins_level_sof"=>$ins_level_sof,"ins_level_technical"=>$ins_level_technical]);
    }

    public function getValuesByEiin(Request $request){
        $eiin= $request->eiin;
        $institution_type= $request->institution_type;
        //dd($request->all());
        //$res= Banbeis::with('banbeisFacility','banbeisLab')->where('eiin',$eiin)->first();

        if($eiin == ''){
            $res = Banbeis::with('banbeisFacility','banbeisLab','banbeisExtra','banbeisMpo')->limit(5)->get();
        }else{
            $res = Banbeis::with('banbeisFacility','banbeisLab','banbeisExtra','banbeisMpo')->where('eiin', 'like', '%' .$eiin . '%')->limit(5)->get();
//            $area= Banbeis::join('bd', function($q)
//            {
//                $q->on('bd.division_en', '=', 'banbeis.division')
//                    ->on('bd.district_en', '=', 'banbeis.district')
//                    ->on('bd.upazila_en', '=', 'banbeis.upazila');
//            })->where('banbeis.eiin',$eiin)->get(['bd.division', 'bd.district','bd.upazila']);
        }

        $response = array();
        //$areaRes= array();
        //dd($area->toArray());

//        foreach ($area  as $ar){
//            $areaRes[]=['division'=>$ar->division,
//                'district'=> $ar->district
//                //'upazila'=>$ar->upazila
//            ];
//        }
//        if(!empty($area)){
//            $upazila=$area[0]['upazila'];
//            $upazilas= Bangladesh::
//            where("district",$area[0]['district'])
//                ->orderByRaw("FIELD(upazila , '$upazila') Desc")
//                ->pluck('upazila','upazila');
//            //dd($upazilas);
//            $areaRes=array_merge($areaRes[0],['upazilas'=>$upazilas->toArray()]);
//        }

        foreach($res as $rs){
            // $electricity_solar=($rs->banbeisFacility->electricity=="YES")?$rs->banbeisFacility->electricity:$rs->banbeisFacility->solar;
            //$packa_semi_packa=($rs->banbeisFacility->packa=="YES" || $rs->banbeisFacility->semi_packa=="YES")?"YES":"NO";
            $response[] = ['value' => $rs->institution,
                'label'=>$rs->eiin,'mobile'=>!empty($rs->banbeisExtra->mobile)?$rs->banbeisExtra->mobile:'',
                'ex'=>$res,
                //'area'=> $areaRes,
                'total_boys'=>$rs->total_students-$rs->total_girls,'total_girls'=>$rs->total_girls,'total_teachers'=>$rs->total_teachers,
                'is_mpo'=> $this->getIsMpo($rs),'mpo'=>$this->getMpo($rs,$institution_type),
                'management'=>$rs->banbeisExtra->management, 'student_type'=>$rs->banbeisExtra->student_type,
                'internet_connection'=>$rs->banbeisFacility->internet,'ict_teacher'=>$rs->banbeisFacility->ict_teacher,
                //'own_lab'=>$rs->banbeisLab->own_lab,'total_pc_own'=>$rs->banbeisExtra->own_pc,
                'govlab'=>$this->getHavingLab($rs),'labs'=> $this->getLabs($rs,'banbeisLab')];//'total_pc_gov_non_gov'=>$rs->banbeisExtra->total_lab_pc,
            //'packa_semi_packa'=>$packa_semi_packa,
            //'electricity_solar'=>$electricity_solar,'cctv'=>$rs->banbeisFacility->cc_camera,'security_guard'=>$rs->banbeisFacility->security_guard]  ;
        }

        return response()->json($response);

    }

    public function store(CreateApplicationRequest $request){
        //dd($request->all());
        if(!Auth::user()->hasRole(['super admin']))
            return abort(404);
        $application = Application::create([
            'lab_type' => $request->get('lab_type'),
            'institution_bn' => $request->get('institution_bn'),
            'institution_type' => $request->get('institution_type'),
            'institution_level' => !empty($request->get('institution_level'))?$request->get('institution_level'):'',
            'division' => $request->get('division'),
            'district' => $request->get('district'),
            'upazila' => $request->get('upazila'),
            'union_pourashava_ward' => !empty($request->get('union_pourashava_ward'))?$request->get('union_pourashava_ward'):'',
            'seat_type' => $request->get('seat_type'),
            'parliamentary_constituency' => !empty($request->get('parliamentary_constituency'))?$request->get('parliamentary_constituency'):'',
            'seat_no' => !empty($request->get('parliamentary_constituency'))?$this->getSeatNo($request->get('parliamentary_constituency')):'',
            'is_parliamentary_constituency_ok' => (!empty($request->get('is_parliamentary_constituency_ok'))&&!empty($request->get('parliamentary_constituency')))?"YES":"",
            'listed_by_deo' => !empty($request->get('listed_by_deo'))?"YES":"NO",
        ]);
        if(($request->get('hidden_is_parliamentary_constituency_ok')=="NO") && !empty($request->get('parliamentary_constituency'))){
            $application->is_parliamentary_constituency_ok= "NO";
        }
        $attachment= new ApplicationAttachment();
        if( !empty($request->get('listed_by_deo')) && $request->hasFile('list_attachment_file')){
            $attachment->member_name= !empty($request->get('member_name'))?$request->get('member_name'):'';
            $attachment=$this->fileUpload($request,$request->file("list_attachment_file"),$attachment,'list_attachment_file');
            $application->attachment()->save($attachment);
        }
        if(empty($request->get('listed_by_deo'))&&!empty($request->get('reference'))){
            $attachment=$this->storeReference($request,$attachment);
            $application->attachment()->save($attachment);
        }
        $profile= new ApplicationProfile();
            $profile->eiin= !empty($request->get('eiin'))?$request->get('eiin'):'';
            $profile->management= !empty($request->get('management'))?$request->get('management'):'';
            $profile->institution_corrected= (!empty($request->get('is_institution_bn_correction_needed'))&&!empty($request->get('institution_corrected')))?$request->get('institution_corrected'):'';
            $profile->institution= !empty($request->get('institution'))?$request->get('institution'):'';
            $profile->union_others= (!empty($request->get('union_pourashava_ward')=="অন্যান্য")&&!empty($request->get('union_others')))?$request->get('union_others'):'';
            $profile->ward= !empty($request->get('ward'))?$request->get('ward'):'';
            $profile->village_road= !empty($request->get('village_road'))?$request->get('village_road'):'';
            $profile->post_office= !empty($request->get('post_office'))?$request->get('post_office'):'';
            $profile->post_code= !empty($request->get('post_code'))?$request->get('post_code'):'';
            $profile->distance_from_upazila_complex= !empty($request->get('distance_from_upazila_complex'))?$request->get('distance_from_upazila_complex'):'';
            //$profile->direction= !empty($request->get('direction'))?$request->get('direction'):'';
            $profile->proper_road= !empty($request->get('proper_road'))?"YES":"NO";
            $profile->latitude= !empty($request->get('latitude'))?$request->get('latitude'):'';
            $profile->longitude= !empty($request->get('longitude'))?$request->get('longitude'):'';

            $profile->head_name= !empty($request->get('head_name'))?$request->get('head_name'):'';
            $profile->institution_email= !empty($request->get('institution_email'))?$request->get('institution_email'):'';
            $profile->institution_tel= !empty($request->get('institution_tel'))?$request->get('institution_tel'):'';
            $profile->alt_name= !empty($request->get('alt_name'))?$request->get('alt_name'):'';
            $profile->alt_tel= !empty($request->get('alt_tel'))?$request->get('alt_tel'):'';
            $profile->alt_email= !empty($request->get('alt_email'))?$request->get('alt_email'):'';

            $profile->mpo= !empty($request->get('mpo'))?$request->get('mpo'):'';
            $profile->total_boys= !empty($request->get('total_boys'))?$request->get('total_boys'):0;
            $profile->total_girls= !empty($request->get('total_girls'))?$request->get('total_girls'):0;
            //$application->total_teachers= !empty($request->get('total_teachers'))?$request->get('total_teachers'):0;
            //$application->management= !empty($request->get('management'))?$request->get('management'):'';
            //$application->student_type= !empty($request->get('student_type'))?$request->get('student_type'):'';
        $application->profile()->save($profile);

        if(!empty($request->get('verification'))){
            if(!empty($request->get('labs'))){
                    $applicationlabs= new ApplicationLab();
                    $applicationlabs=$this->storeLabs($request->get('labs'),$applicationlabs);
                    $applicationlabs->lab_others_title= (in_array("Others",$request->get('labs'))&&!empty($request->get('lab_others_title')))?$request->get('lab_others_title'):'';
                    $application->lab()->save($applicationlabs);
            }
            $verified= new ApplicationVerification();
                $verified->govlab= !empty($request->get('govlab'))?"YES":"NO";
                $verified->proper_infrastructure= !empty($request->get('proper_infrastructure'))?"YES":"NO";
                $verified->proper_room= !empty($request->get('proper_room'))?"YES":"NO";
                $verified->electricity_solar= !empty($request->get('electricity_solar'))?"YES":"NO";
                $verified->proper_security= !empty($request->get('proper_security'))?"YES":"NO";
                $verified->lab_maintenance= !empty($request->get('lab_maintenance'))?"YES":"NO";
                $verified->lab_prepared= !empty($request->get('lab_prepared'))?"YES":"NO";

                $verified->internet_connection= !empty($request->get('internet_connection'))?"YES":"NO";
                $verified->internet_connection_type= !empty($request->get('internet_connection_type'))?$request->get('internet_connection_type'):'';
                $verified->good_result= !empty($request->get('good_result'))?"YES":"NO";
                $verified->about_institution= !empty($request->get('about_institution'))?$request->get('about_institution'):'';
                $verified->has_ict_teacher= !empty($request->get('has_ict_teacher'))?"YES":"NO";

                $verified->app_upazila_verified= !empty($request->get('app_upazila_verified'))?"YES":"NO";
                $verified->app_district_verified= !empty($request->get('app_district_verified'))?"YES":"NO";
                $verified->app_duplicate= !empty($request->get('app_duplicate'))?"YES":"NO";
    //            $verified->is_eiin= !empty($request->get('is_eiin'))?"YES":"NO";
    //            $verified->is_mpo= !empty($request->get('is_mpo'))?"YES":"NO";
    //            $verified->is_broadband= !empty($request->get('is_broadband'))?"YES":"NO";
            $application->verification()->save($verified);
            if(!empty($request->hasFile('verification_report_file'))){
                $attachment=$this->storeVerificationReport($request,$attachment);
                $application->attachment()->save($attachment);
            }
        }
        if(!empty($request->get('old_app'))){
            $attachment=$this->storeOldApp($request,$attachment);
            $application->attachment()->save($attachment);
        }
        $application->save();
        //dd($application->toArray());
        Flash::success('প্রতিষ্ঠানটি সফলভাবে নিবন্ধিত হয়েছে।');
        return redirect()->route('applications.index')->with('status','আপনার আবেদনটি সফলভাবে জমা দেওয়া হয়েছে।!');
    }
    public function getMemberName($member_name,$request)
    {
        if(!empty($request->get('seat_no'))){
            $seat_no= $request->get('seat_no');

        }
    }
    public function displayPdf($id,$path){
        $application= Application::where('id',$id)->with('attachment')->first();
        if(!empty($application->attachment->$path)){
            //$file =  base_path().'/public/uploads/documents/'.$application;
            $fileName =  $application->attachment->$path;
            $file=Storage::path($fileName);

           if (file_exists($file)){

                $ext =File::extension($file);
                //dd($ext);
                if($ext=='pdf'){
                    $content_types='application/pdf';
                }elseif ($ext=='doc') {
                    $content_types='application/msword';
                }elseif ($ext=='docx') {
                    $content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                }elseif ($ext=='xls') {
                    $content_types='application/vnd.ms-excel';
                }elseif ($ext=='xlsx') {
                    $content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                }elseif ($ext=='txt') {
                    $content_types='application/octet-stream';
                }

                return response(file_get_contents($file),200)
                    ->header('Content-Type',$content_types);

            }else{
               abort(404);
               //exit('Requested file does not exist on our server!');
            }

        }else{
            abort(404);
        }
    }
    public function sms(){
        $client = new Client(['base_uri' => 'https://api.mobireach.com.bd/SendTextMessage']);

//        $response = $client->request('GET', '', ['query' => ['Username' => 'srdl',
//            "Password" => "Doict97!","From"=>"SRDL","To"=>"8801672702437","Message"=>"Faria kutta"]]);

        $response = $client->request('POST', '', ['form_params' => [
            'Username' => 'srdl',
            'Password' => 'Doict97!',
            'From'=>'SRDL',
            'To'=>'8801673556748',
            'Message'=>'Shuvo Gutibaz'
        ]]);


        echo $response->getBody();
    }
    public function getMpo($res,$ins_type){
        if($ins_type == "school" || $ins_type= "school and college")
            return $res->banbeisMpo->mpo_school;
        elseif ($ins_type == "college" ) return  $res->banbeisMpo->mpo_college;
        else return  $res->banbeisMpo->mpo_madrasha;
    }
    public function getIsMpo($res){
        if ($res->banbeisMpo->mpo_school !=""||$res->banbeisMpo->mpo_college != ""|| $res->banbeisMpo->mpo_madrasha != '')
            return "YES";
        else return "NO";
    }

    public function getLabs($rs,$rel)
    {
        $labs=[];
        if(!empty($rs->$rel->lab_by_srdl))
            $labs[]='Sheikh Russel Digital Lab';
        if(!empty($rs->$rel->lab_by_bcc))
            $labs[]='Bangladesh Computer Council';
        if(!empty($rs->$rel->lab_by_moe))
            $labs[]='Ministry of Education';
        if(!empty($rs->$rel->lab_by_dshe))
            $labs[]='Directorate of Secondary and Higher Education';
        if(!empty($rs->$rel->lab_by_edu_board))
            $labs[]='Education Board';
        if(!empty($rs->$rel->lab_by_ngo))
            $labs[]='NGO';
//        if(!empty($rs->banbeisLab->own_lab))
//            $labs[]='Own Lab';
        if(!empty($rs->$rel->lab_by_local_gov))
            $labs[]='Local Government';
        if(!empty($rs->$rel->lab_by_others))
            $labs[]='Others';
        return $labs;
    }

    protected function getHavingLab($rs)
    {
        if(!empty($rs->banbeisLab->lab_by_srdl)||!empty($rs->banbeisLab->lab_by_bcc)||!empty($rs->banbeisLab->lab_by_moe)||
            !empty($rs->banbeisLab->lab_by_dshe)||!empty($rs->banbeisLab->lab_by_edu_board)||
            !empty($rs->banbeisLab->lab_by_ngo)||!empty($rs->banbeisLab->lab_by_local_gov)||!empty($rs->banbeisLab->lab_by_others))
            return "YES";
        else return "NO";
    }

    protected function storeLabs( $labs,$applicationlabs)
    {
        foreach ($labs as $lab){
            if($lab == "Sheikh Russel Digital Lab")$applicationlabs->lab_by_srdl= "YES";
            if($lab== "Bangladesh Computer Council")$applicationlabs->lab_by_bcc= "YES";
            if($lab== "Ministry of Education")$applicationlabs->lab_by_moe= "YES";
            if($lab== "Directorate of Secondary and Higher Education")$applicationlabs->lab_by_dshe= "YES";
            if($lab== "Education Board")$applicationlabs->lab_by_edu_board= "YES";
            if($lab== "Others")$applicationlabs->lab_by_others= "YES";
        }
        return $applicationlabs;
    }

    protected function storeVerificationReport(Request $request, $attachment)
    {
        if(!empty($request->hasFile("verification_report_file")))
            return $this->fileUpload($request,$request->file("verification_report_file"),$attachment,'verification_report_file');
        return  $attachment;
    }

    protected function storeReference(Request $request, $attachment)
    {
        $attachment->ref_type=!empty($request->get('ref_type'))?$request->get('ref_type'):null;
        $attachment->ref_name=!empty($request->get('ref_name'))?$request->get('ref_name'):null;
        $attachment->ref_designation=!empty($request->get('ref_designation'))?$request->get('ref_designation'):null;
        $attachment->ref_office=!empty($request->get('ref_office'))?$request->get('ref_office'):null;
        //dd($request->toArray());
        if(!empty($request->hasFile("ref_documents_file")))
            return $this->fileUpload($request,$request->file("ref_documents_file"),$attachment,'ref_documents_file');
        return  $attachment;

    }

    protected function storeOldApp(Request $request, $attachment)
    {
        $attachment->old_application_date=!empty($request->get('old_application_date'))?$request->get('old_application_date'):null;
        if(!empty($request->hasFile("old_application_attachment")))
            return $this->fileUpload($request,$request->file("old_application_attachment"),$attachment,'old_application_attachment');
        return $attachment;
    }
    public function fileUpload(Request $req,$file,$attachment,$ex){
        $appFilePath= $ex."_path";
        if(!empty($attachment->$appFilePath) &&!filter_var($attachment->$appFilePath, FILTER_VALIDATE_URL) ){
            Storage::delete($attachment->$appFilePath);
        }
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $req->file($ex)->storeAs('uploads', $fileName, 'public');
        $attachment->$ex = time().'_'.$file->getClientOriginalName();
        $attachment->$appFilePath = $filePath;
        return $attachment;
    }
    public function  show($id){
        $application=Application::where('id',$id)->with('attachment','lab','verification','profile')->first();
        $labs=[];
        $tag= new \Spatie\Tags\Tag;
        $tags=\Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name]=$tag->translate('name', 'bn');
        }
        $selectedLabs=$this->getLabs($application,'lab');
        $listAttachmentFile= $this->getListAttachmentFile($application);
        $listAttachmentFilePathType=$this->getListAttachmentFilePathType($application);
        $ins_type= Arr::except(ins_type(),[""]);
        $ins_level= Arr::only(ins_level(), array('primary','junior_secondary','secondary','higher_secondary','secondary_and_higher',"graduation","others"));
        $ins_type_sof= Arr::only($ins_type, array('general', 'madrasha', 'technical'));
        $ins_level_sof= $array = Arr::only(ins_level(), array('secondary', 'secondary_and_higher'));
        $ins_level_technical= $array = Arr::only(ins_level(), array('junior_secondary','secondary','higher_secondary','secondary_and_higher',"diploma","others"));
        $districtVerified=$this->getDistrictVerificationStatus(Auth::user());
        return view('applications.pdf-demo',['application'=>$application,"ins_type"=>$ins_type,"ins_level"=>$ins_level,
            "ins_type_sof"=>$ins_type_sof,"ins_level_sof"=>$ins_level_sof,
            "ins_level_technical"=>$ins_level_technical,'labs'=>$labs,'selectedLabs'=>$selectedLabs,
            'listAttachmentFile'=>$listAttachmentFile,'listAttachmentFilePathType'=>$listAttachmentFilePathType,
            'districtVerified'=>$districtVerified]);
        //return response()->json($application);
        //return view('applications.preview');
    }

    protected function getSeatNo($parliamentary_constituency){
        //dd($parliamentary_constituency);
        $bd=Bangladesh::where('parliamentary_constituency',$parliamentary_constituency)->first();
        if(!empty($bd))
            return $bd->seat_no;
        else{
            $reserved_seats=ReservedSeats();
            foreach ($reserved_seats as $key=>$reserved_seat){
                if($reserved_seat['parliamentary_constituency']== $parliamentary_constituency){
                    return $reserved_seat['seat_no'];
                }
            }
            return "";
        }
    }
    public function update(Application $application, Request $request)
    {
        $application->eiin = $request->eiin;
        $application->institution = $request->institution;
        $application->institution_email = $request->institution_email;
        $application->institution_tel = $request->institution_tel;
        $application->total_boys = $request->total_boys;
        $application->total_girls = $request->total_girls;
        $application->mpo = isset($request->is_mpo) && $request->mpo ? $request->mpo : '';
        $application->internet_connection = isset($request->internet_connection) ? 'YES' : 'NO';
        $application->internet_connection_type = $request->internet_connection_type;
        $application->ict_edu = isset($request->ict_edu) ? 'YES' : 'NO' ;
        $application->ict_teacher = isset($request->ict_teacher) ? 'YES' : 'NO' ;
        $application->good_result = isset($request->good_result) ? 'YES' : 'NO' ;
        $application->about_institution = $request->about_institution;
        $application->save();

    }

    public function getListAttachmentFilePathType(Application $application)
    {
        $list_attachment= !empty($application->attachment->list_attachment_file_path)?$application->attachment:null;
        if(empty($application->attachment->list_attachment_file_path))
            $list_attachment=$this->getListAttachmentFileIfNotExists($application);
        if(!empty($list_attachment)){
            if(filter_var($list_attachment->list_attachment_file_path, FILTER_VALIDATE_URL))
                return "প্রেরিত তালিকাটি দেখুন- google drive" ;
            elseif(!empty($list_attachment->list_attachment_file_path))
                return "প্রেরিত তালিকাটি দেখুন- local drive";
        }
        return  null;
    }
    public function getListAttachmentFile(Application $application)
    {
        $list_attachment= !empty($application->attachment->list_attachment_file_path)?$application->attachment:null;
        if(empty($application->attachment->list_attachment_file_path)){
            $list_attachment=$this->getListAttachmentFileIfNotExists($application);
        }
        if(!empty($list_attachment)){
            if(filter_var($list_attachment->list_attachment_file_path, FILTER_VALIDATE_URL))
                return $list_attachment->list_attachment_file_path;
            elseif(!empty($list_attachment->list_attachment_file_path))
                return route('applications.displayPdf',['id' => $list_attachment->application_attachment_id,'path'=>'list_attachment_file_path']);
        }
        return  null;
    }
    private function getListAttachmentFileIfNotExists(Application $application)
    {

        if($application->listed_by_deo !="YES" )
            return null;
        $app=Application::where('seat_no',$application->seat_no)->whereHas('attachment', function ($query) {
            $query->whereNotNull('list_attachment_file_path');
        })->first();
        return  !empty($app)?$app->attachment:null;

//            $list_attachment_file=$attachment->whereNotNull('list_attachment_file_path')->whereHas('application', function ($query) use($seat_no) {
//                $query->where('seat_no', $seat_no);
//            })->first();
        //dd($app->toArray());
    }

    private function getDistrictVerificationStatus($user)
    {
        if($user->hasRole('upazila admin')){
            $upazila_en=explode('_',$user->username)[0];
            $district_en=explode('_',$user->username)[1];
            $district_username= $district_en.'_admin';
            $district_user= User::where('username',$district_username)->first();
            if($district_user->verified=='YES') return true;
            else false;
        }
        return false;
    }


}
