<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Banbeis;
use App\Models\Bangladesh;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Application::latest()->get();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<a href='javascript:void(0)' data-application='" . json_encode($row) . "' class='edit btn btn-success btn-sm'>Edit</a>
                            <a href='javascript:void(0)' class='delete btn btn-danger btn-sm'>Delete</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('applications.index');
    }

    public function terms()
    {
        return view('applications.terms');
    }

    public function create()
    {

        $labs = [];
        $tag = new \Spatie\Tags\Tag;
        $tags = \Spatie\Tags\Tag::all();
        foreach ($tags as $tag) {
            $labs[$tag->name] = $tag->translate('name', 'bn');
        }
        $divisionList = [];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key => $division)
            $divisionList[$division['division']] = $division['division'];
        return view('applications.create', ['labs' => $labs, 'divisionList' => $divisionList]);
    }

    public function getValuesByEiin(Request $request)
    {
        $eiin = $request->eiin;
        $institution_type = $request->institution_type;
        //dd($request->all());
        //$res= Banbeis::with('banbeisFacility','banbeisLab')->where('eiin',$eiin)->first();

        if ($eiin == '') {
            $res = Banbeis::with('banbeisFacility', 'banbeisLab', 'banbeisExtra', 'banbeisMpo')->limit(5)->get();
        } else {
            $res = Banbeis::with('banbeisFacility', 'banbeisLab', 'banbeisExtra', 'banbeisMpo')->where('eiin', 'like', '%' . $eiin . '%')->limit(5)->get();
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

        foreach ($res as $rs) {
            // $electricity_solar=($rs->banbeisFacility->electricity=="YES")?$rs->banbeisFacility->electricity:$rs->banbeisFacility->solar;
            //$packa_semi_packa=($rs->banbeisFacility->packa=="YES" || $rs->banbeisFacility->semi_packa=="YES")?"YES":"NO";
            $response[] = ['value' => $rs->institution,
                'label' => $rs->eiin, 'mobile' => !empty($rs->banbeisExtra->mobile) ? $rs->banbeisExtra->mobile : '',
                'ex' => $res,
                //'area'=> $areaRes,
                'total_boys' => $rs->total_students - $rs->total_girls, 'total_girls' => $rs->total_girls, 'total_teachers' => $rs->total_teachers,
                'is_mpo' => $this->getIsMpo($rs), 'mpo' => $this->getMpo($rs, $institution_type),
                'management' => $rs->banbeisExtra->management, 'student_type' => $rs->banbeisExtra->student_type,
                'internet_connection' => $rs->banbeisFacility->internet, 'ict_teacher' => $rs->banbeisFacility->ict_teacher,
                //'own_lab'=>$rs->banbeisLab->own_lab,'total_pc_own'=>$rs->banbeisExtra->own_pc,
                'govlab' => $this->getHavingLab($rs), 'labs' => $this->getLabs($rs)];//'total_pc_gov_non_gov'=>$rs->banbeisExtra->total_lab_pc,
            //'packa_semi_packa'=>$packa_semi_packa,
            //'electricity_solar'=>$electricity_solar,'cctv'=>$rs->banbeisFacility->cc_camera,'security_guard'=>$rs->banbeisFacility->security_guard]  ;
        }

        return response()->json($response);

    }

    public function store(Request $request)
    {
        //dd($request->all());
        $application = Application::create([
            'lab_type' => $request->get('lab_type'),
            'institution_type' => $request->get('institution_type'),
            'institution_bn' => $request->get('institution_bn'),
            'division' => $request->get('division'),
            'district' => $request->get('district'),
            'upazila' => $request->get('upazila'),
            'union_pourashava_ward' => !empty($request->get('union_pourashava_ward')) ? $request->get('union_pourashava_ward') : '',
            'seat_type' => $request->get('seat_type'),
            'seat_no' => !empty($request->get('parliamentary_constituency')) ? $request->get('parliamentary_constituency') : '',
            'is_parliamentary_constituency_ok' => (!empty($request->get('is_parliamentary_constituency_ok')) && !empty($request->get('parliamentary_constituency'))) ? "YES" : "",
            'listed_by_deo' => !empty($request->get('listed_by_deo')) ? "YES" : "NO",
            'member_name' => !empty($request->get('member_name')) ? $request->get('member_name') : '',
        ]);
        if (($request->get('hidden_is_parliamentary_constituency_ok') == "NO") && !empty($request->get('parliamentary_constituency'))) {
            $application->is_parliamentary_constituency_ok = "NO";
        }
        if ($request->hasFile('list_attachment_file')) {
            $application = $this->fileUpload($request, $request->file("list_attachment_file"), $application, 'list_attachment_file');
        }
        //exit;
        if (empty($request->get('listed_by_deo'))) {
            $application->eiin = !empty($request->get('eiin')) ? $request->get('eiin') : '';
            $application->institution = !empty($request->get('institution')) ? $request->get('institution') : '';
            $application->institution_email = !empty($request->get('institution_email')) ? $request->get('institution_email') : '';
            $application->institution_tel = !empty($request->get('institution_tel')) ? $request->get('institution_tel') : '';
            $application->total_boys = !empty($request->get('total_boys')) ? $request->get('total_boys') : 0;
            $application->total_girls = !empty($request->get('total_girls')) ? $request->get('total_girls') : 0;
            //$application->total_teachers= !empty($request->get('total_teachers'))?$request->get('total_teachers'):0;
            //$application->management= !empty($request->get('management'))?$request->get('management'):'';
            //$application->student_type= !empty($request->get('student_type'))?$request->get('student_type'):'';
            $application->mpo = !empty($request->get('mpo')) ? $request->get('mpo') : '';
            $application->internet_connection = !empty($request->get('internet_connection')) ? "YES" : '';
            $application->internet_connection_type = !empty($request->get('internet_connection_type')) ? $request->get('internet_connection_type') : '';
            $application->ict_edu = !empty($request->get('ict_edu')) ? "YES" : '';
            $application->ict_teacher = !empty($request->get('ict_teacher')) ? "YES" : '';

            $this->storeLabs($request, $application);
            $application->proper_infrastructure = !empty($request->get('proper_infrastructure')) ? "YES" : null;
            $application->proper_room = !empty($request->get('proper_room')) ? "YES" : null;
            $application->electricity_solar = !empty($request->get('electricity_solar')) ? "YES" : null;
            $application->proper_security = !empty($request->get('proper_security')) ? "YES" : null;
            $application->good_result = !empty($request->get('good_result')) ? "YES" : null;
            $application->about_institution = !empty($request->get('about_institution')) ? $request->get('about_institution') : '';
            $application->lab_maintenance = !empty($request->get('lab_maintenance')) ? "YES" : null;
            $application->lab_prepared = !empty($request->get('lab_prepared')) ? "YES" : null;
            if (!empty($request->get('reference'))) $this->storeReference($request, $application);
            if (!empty($request->get('old_app'))) $this->storeOldApp($request, $application);
        }
        $application->save();
        //dd($application->toArray());
        return redirect()->route('home1')->with('status', 'আপনার আবেদনটি সফলভাবে জমা দেওয়া হয়েছে।!');
    }

    public function sms()
    {
        $client = new Client(['base_uri' => 'https://api.mobireach.com.bd/SendTextMessage']);

//        $response = $client->request('GET', '', ['query' => ['Username' => 'srdl',
//            "Password" => "Doict97!","From"=>"SRDL","To"=>"8801672702437","Message"=>"Faria kutta"]]);

        $response = $client->request('POST', '', ['form_params' => [
            'Username' => 'srdl',
            'Password' => 'Doict97!',
            'From' => 'SRDL',
            'To' => '8801673556748',
            'Message' => 'Shuvo Gutibaz'
        ]]);


        echo $response->getBody();
    }

    public function getMpo($res, $ins_type)
    {
        if ($ins_type == "school" || $ins_type = "school and college")
            return $res->banbeisMpo->mpo_school;
        elseif ($ins_type == "college") return $res->banbeisMpo->mpo_college;
        else return $res->banbeisMpo->mpo_madrasha;
    }

    public function getIsMpo($res)
    {
        if ($res->banbeisMpo->mpo_school != "" || $res->banbeisMpo->mpo_college != "" || $res->banbeisMpo->mpo_madrasha != '')
            return "YES";
        else return "NO";
    }

    public function getLabs($rs)
    {
        $labs = [];
        if (!empty($rs->banbeisLab->lab_by_srdl))
            $labs[] = 'Sheikh Russel Digital Lab';
        if (!empty($rs->banbeisLab->lab_by_bcc))
            $labs[] = 'Bangladesh Computer Council';
        if (!empty($rs->banbeisLab->lab_by_moe))
            $labs[] = 'Ministry of Education';
        if (!empty($rs->banbeisLab->lab_by_dshe))
            $labs[] = 'Directorate of Secondary and Higher Education';
        if (!empty($rs->banbeisLab->lab_by_edu_board))
            $labs[] = 'Education Board';
        if (!empty($rs->banbeisLab->lab_by_ngo))
            $labs[] = 'NGO';
//        if(!empty($rs->banbeisLab->own_lab))
//            $labs[]='Own Lab';
        if (!empty($rs->banbeisLab->lab_by_local_gov))
            $labs[] = 'Local Government';
        if (!empty($rs->banbeisLab->lab_by_others))
            $labs[] = 'Others';
        return $labs;
    }

    private function getHavingLab($rs)
    {
        if (!empty($rs->banbeisLab->lab_by_srdl) || !empty($rs->banbeisLab->lab_by_bcc) || !empty($rs->banbeisLab->lab_by_moe) ||
            !empty($rs->banbeisLab->lab_by_dshe) || !empty($rs->banbeisLab->lab_by_edu_board) ||
            !empty($rs->banbeisLab->lab_by_ngo) || !empty($rs->banbeisLab->lab_by_local_gov) || !empty($rs->banbeisLab->lab_by_others))
            return "YES";
        else return "NO";
    }

    private function storeLabs(Request $request, $application)
    {
        $labs = $request->get('labs');
        if (!empty($labs)) {
            foreach ($labs as $lab) {
                if ($lab == "Sheikh Russel Digital Lab") $application->lab_by_srdl = "YES";
                if ($lab == "Bangladesh Computer Council") $application->lab_by_bcc = "YES";
                if ($lab == "Ministry of Education") $application->lab_by_moe = "YES";
                if ($lab == "Directorate of Secondary and Higher Education") $application->lab_by_dshe = "YES";
                if ($lab == "Education Board") $application->lab_by_edu_board = "YES";
                if ($lab == "NGO") $application->lab_by_ngo = "YES";
                if ($lab == "Local Government") $application->lab_by_local_gov = "YES";
                if ($lab == "Others") $application->lab_by_others = "YES";
            }
        }
        $application->save();

    }

    private function storeReference(Request $request, $application)
    {
        $application->ref_type = !empty($request->get('ref_type')) ? $request->get('ref_type') : null;
        $application->ref_name = !empty($request->get('ref_name')) ? $request->get('ref_name') : null;
        $application->ref_designation = !empty($request->get('ref_designation')) ? $request->get('ref_designation') : null;
        $application->ref_office = !empty($request->get('ref_office')) ? $request->get('ref_office') : null;
        //dd($request->toArray());
        if (!empty($request->hasFile("ref_documents_file")))
            $this->fileUpload($request, $request->file("ref_documents_file"), $application, 'ref_documents_file');

    }

    private function storeOldApp(Request $request, $application)
    {
        $application->old_application_date = !empty($request->get('old_application_date')) ? $request->get('old_application_date') : null;
        if (!empty($request->hasFile("old_application_attachment")))
            $this->fileUpload($request, $request->file("old_application_attachment"), $application, 'old_application_attachment');
    }

    public function fileUpload(Request $req, $file, $application, $ex)
    {
        //dd('in fileUpload');
        $req->validate([
            'ref_documents_file' => 'mimes:csv,txt,xlx,xls,pdf|max:2048',
            'old_application_attachment' => 'mimes:csv,txt,xlx,xls,pdf|max:2048',
            'list_attachment_file' => 'mimes:jpeg,pdf,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time() . '_' . $file->getClientOriginalName();
        //dd($fileName);
        $filePath = $req->file($ex)->storeAs('uploads', $fileName, 'public');

        $application->$ex = time() . '_' . $file->getClientOriginalName();
        $appFilePath = $ex . "_path";
        $application->$appFilePath = '/storage/' . $filePath;
        return $application;
    }

    public function applicationPreview()
    {
        return view('applications.preview');
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
}
