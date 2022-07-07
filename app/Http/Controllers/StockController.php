<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Http\Requests\CreateStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Bangladesh;
use App\Models\Lab;
use App\Repositories\StockRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class StockController extends AppBaseController
{
    /** @var  StockRepository */
    private $stockRepository;

    public function __construct(StockRepository $stockRepo)
    {
        $this->stockRepository = $stockRepo;
    }

    /**
     * Display a listing of the Stock.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $labs= Lab::all();
        $stocks = $this->stockRepository->all();

        return view('stocks.index',['stocks'=>$stocks,'labs'=>$labs]);
    }
    public function stocks(StockDataTable $dataTable,Request $request)
    {
        $divisionList=[];
        $divisions = Bangladesh::distinct()->get("division")->toArray();
        foreach ($divisions as $key=>$division)
            $divisionList[$division['division']]=$division['division'];
        $divisionList=array_merge(['-1' => 'নির্বাচন করুন'], $divisionList);
        //$parliamentaryConstituencyList= $this->getParliamentaryConstituency($request);
        $upazilas= $this->getUpazilas($request);
        return $dataTable->render('stocks.lab_stocks',['divisionList'=>$divisionList,'upazilas'=>$upazilas,'district_bn'=>$this->getDistrictBnNameByUser()]);
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
    /**
     * Show the form for creating a new Stock.
     *
     * @return Response
     */
    public function create($labId)
    {
        return view('stocks.create',['labId'=>$labId]);
    }

    /**
     * Store a newly created Stock in storage.
     *
     * @param CreateStockRequest $request
     *
     * @return Response
     */
    public function store($labId,CreateStockRequest $request)
    {
        $lab= Lab::where('id',$labId)->with('stock')->first();
        $input = $request->all();
        $input= array_merge(['lab_id'=>$labId],$input);
        $stock = $this->stockRepository->create($input);

        Flash::success('Stock saved successfully.');

        return redirect(route('labs.stocks.index'));
    }

    /**
     * Display the specified Stock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('labs.stocks.index'));
        }

        return view('stocks.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified Stock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($labId,$stockId)
    {
        $lab= Lab::where('id',$labId)->with('stock')->first();
        $stock = $this->stockRepository->find($stockId);
        if (empty($lab->stock)) {
            Flash::error('Stock not found');
            return redirect(route('labs.stocks.index'));
        }

        return view('stocks.edit',['stock'=>$stock,'lab'=>$lab]);
    }

    /**
     * Update the specified Stock in storage.
     *
     * @param int $id
     * @param UpdateStockRequest $request
     *
     * @return Response
     */
    public function update($labId,$stockId, UpdateStockRequest $request)
    {
        $input = $request->all();
        $input= array_merge(['lab_id'=>$labId],$input);
        $lab= Lab::where('id',$labId)->with('stock')->first();
        $stock = $this->stockRepository->find($stockId);

        if (empty($stock)) {
            Flash::error('Stock not found');
            return redirect(route('labs.stocks.index'));
        }

        $stock = $this->stockRepository->update($input, $stockId);

        Flash::success('Stock updated successfully.');

        return redirect(route('labs.stocks.index'));
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

}
