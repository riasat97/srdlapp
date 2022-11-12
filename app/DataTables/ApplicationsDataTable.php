<?php

namespace App\DataTables;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApplicationsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $user= Auth::user();
        return datatables()
            ->eloquent($query)
            ->addIndexColumn();
            /*->addColumn('action', function ($row)use ($user) {
                //dd($row->id);
                if($user->hasRole('super admin'))$btn="<a href='".route("applications.edit",$row->id)."' target=\"_blank\" class='super-admin-edit btn btn-info btn-sm'>App Edit</a> "; else $btn="";
                $btn = $btn."<a href='javascript:void(0)' data-application='" . json_encode($row) . "' class='edit btn btn-success btn-sm'>Edit</a>
                            <a href='javascript:void(0)' class='delete btn btn-danger btn-sm'>Details</a>";
                return $btn;
            })*/
            //->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Application $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query( Request $request)
    {
        //dd($request->get('divId'));
        return $data=$this->getAppData($request);
        //return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('datatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)

            ->parameters([
                'dom' => 'lBfrtip',
                "pageLength"=> "25",
                'buttons' => [ [
                    'extend' => 'excel',
                    'messageTop' => "SRDL"
                ],'print',  'reset', 'reload','csv'
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('DT_RowIndex','serial')->title('ক্রম'),
            Column::make('division','division')->title('বিভাগ'),
            Column::make('district','district')->title('জেলা'),
            Column::make('constituency','constituency')->title('নির্বাচনী এলাকা'),
            Column::make('upazila','upazila')->title('উপজেলা'),
            Column::make('institution_bn','institution_bn')->title('শিক্ষা প্রতিষ্ঠান'),
            /*Column::computed('action')
                ->exportable(false)
                ->printable(false)
                //->width(60)
                ->addClass('details-control'),*/
        ];
    }
//https://yajrabox.com/docs/laravel-datatables/master/html-builder-column-builder
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Applications_' . date('YmdHis');
    }

    /*protected function getAppData(Request $request)
    {
        //dd($request->all());
        $data = Application::query();
        if (!empty($request->get('divId'))|| !empty($request->get('disId')) || !empty($request->get('parliamentaryConstituencyId'))) {
            if (!empty($request->get('divId'))) {
                $data->where('division', $request->get('divId'));
            }

            if (!empty($request->get('disId'))) {
                $data->where('district', $request->get('disId'));
            }
            if (!empty($request->get('parliamentaryConstituencyId'))) {
                $data->where('parliamentary_constituency', $request->get('parliamentaryConstituencyId'));
            }
            // dd($data->get()->toArray());
            return $data->with('attachment')->latest('id');
            //return $this->applyScopes($data);
        }
        return $data->with('attachment')->permitted(null)->latest('id');
        //return $this->applyScopes($data);
    }*/
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
            return $data->with('attachment','verification')->orderByRaw(" division,district,seat_no asc, FIELD(lab_type , 'sof') DESC,upazila ASC");
            //return $this->applyScopes($data);
        }
        return $data->with('attachment','verification')->permitted(null)->latest('id');
        //return $this->applyScopes($data);
    }
}
