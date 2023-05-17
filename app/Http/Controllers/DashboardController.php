<?php

namespace App\Http\Controllers;

use App\DataTables\ApplicationsDataTable;
use App\DataTables\LabDataTable;
use App\DataTables\OwnLabsDataTable;
use App\DataTables\SelectedInstitutionsDataTable;
use App\DataTables\SelectedLabsDataTable;
use App\Models\Application;
use App\Models\Bangladesh;
use App\Models\Device;
use App\Models\Notice;
use App\Repositories\NoticeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class DashboardController extends Controller
{
    private $noticeRepository;

    public function __construct(NoticeRepository $noticeRepo)
    {
        $this->noticeRepository = $noticeRepo;
    }
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
    public function index()
    {
        $user= Auth::user();
        if(!empty($user)&& !$user->hasRole('super admin')  && $user->status!=1){
            Flash::warning('প্রোফাইল হালনাগাদ করা আবশ্যক!!!');
            return redirect()->route('users.edit',$user->id);
        }
        if($user->hasRole(['super admin','district admin','upazila admin'])) {
            $deo_app_seat_count = Application::where("listed_by_deo", "YES")->whereNotLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
            //dd($deo_app_seat_count);
            $deo_app_seat_total = Application::where("listed_by_deo", "YES")->whereNotLike('parliamentary_constituency', 'মহিলা আসন')->count();
            $deo_app_reserved_seat_count = Application::where("listed_by_deo", "YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->groupBy('seat_no')->get()->count();
            $deo_app_reserved_seat_total = Application::where("listed_by_deo", "YES")->whereLike('parliamentary_constituency', 'মহিলা আসন')->count();
            $sof_total = Application::where("lab_type", "sof")->groupBy('seat_no')->get()->count();
            $other_ref = Application::where("listed_by_deo", "NO")->count();
            $total_app = Application::count();
        }
        if($user->hasRole(['vendor'])){
            $newTicket= $this->getTicketStatusCount('open');
            $processingTicket= $this->getTicketStatusCount('processing');
            $resolvedTicket= $this->getTicketStatusCount('resolved');
            $unresolvedTicket= $this->getTicketStatusCount('unresolved');
            $totalTicket= $this->getTicketStatusCount('all');
            return view('dashboard',['newTicket'=>$newTicket,'processingTicket'=>$processingTicket,
                'resolvedTicket'=>$resolvedTicket,'unresolvedTicket'=>$unresolvedTicket,
                'totalTicket'=>$totalTicket]);
        }
        if($user->hasRole(['trainer'])){
            return redirect()->route('web.selected-labs');
        }

        return view('dashboard',['deo_app_seat_count'=>$deo_app_seat_count,'deo_app_seat_total'=>$deo_app_seat_total,
            'deo_app_reserved_seat_count'=>$deo_app_reserved_seat_count,'deo_app_reserved_seat_total'=>$deo_app_reserved_seat_total,
            'sof_total'=>$sof_total,'other_ref'=>$other_ref,'total_app'=>$total_app]);
    }

    public function application(SelectedLabsDataTable $dataTable,Request $request)
    {
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        $parliamentaryConstituencyList= $this->getParliamentaryConstituency($request);
        $phase= array_merge(['-1' => 'নির্বাচন করুন'],[1=>'১ম',2=>'২য়']);
        return $dataTable->render('selectedInstitutions',['divisionList'=>$divisionList,
        'parliamentaryConstituencyList'=>$parliamentaryConstituencyList,'phase'=>$phase]);
    }
    public function getParliamentaryConstituency(Request $request)
    {
        // dd($request->all());
        //$user=Auth::user();
        //if($user->hasRole(['district admin','upazila admin'])){
            $parliament = Bangladesh::groupBy('parliamentary_constituency')
                ->orderBy('seat_no_en','asc')
                ->pluck('parliamentary_constituency','parliamentary_constituency');
            $parliament=array_merge(['-1' => 'নির্বাচন করুন'], $parliament->toArray());
            return $parliament;
       // }

    }
    public function getHome(){
        $notices = Notice::with('attachments')->where('published_at', '<', now())->orderByDesc('published_at')->take(10)->get();
        //dd($notices);
        return view('index')->with('notices', $notices);
    }
    public function getAbout(){
        return view('about');
    }
    public function showPdf($fileName){
        $file=public_path($fileName);
        return response(file_get_contents($file),200)
            ->header('Content-Type','application/pdf');
    }
    private function getDivisionBn(array $divisions_en)
    {
        $division_bn=[];
        foreach ( $divisions_en as $division_en){
            $division_bn[divisionEnToBn()[$division_en]]=divisionEnToBn()[$division_en];
        }
        return $division_bn;
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
    private function getDistrictBnNameByUser()
    {
        if(Auth::user()->hasRole('district admin')){
            $district_en=strtolower(explode('_',Auth::user()->username)[0]);
            $districtobj= Bangladesh::where('district_en',$district_en)->first();
            return $districtobj->district;
        }
        return  false;
    }
    private function getTicketStatusCount($status){
        $user= Auth::user();
        $divisions_en=explode(',',$user->posting_type);
        $divisions_bn=$this->getDivisionBn($divisions_en);
        $devices=explode(',',$user->designation);
        if($status=='all')
            return Device::whereIn('device',$devices)->whereHas('lab', function ($data) use ($divisions_bn) {
                $data->whereIn('labs.division',$divisions_bn )->where('phase',2);
            })->count();
        else return Device::whereIn('device',$devices)->where('support_status',$status)->whereHas('lab', function ($data) use ($divisions_bn) {
                $data->whereIn('labs.division',$divisions_bn )->where('phase',2);
            })->count();
    }
}
