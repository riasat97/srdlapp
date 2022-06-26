<?php

namespace App\DataTables;

use App\Models\Application;
use App\Models\Dashboard;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SelectedInstitutionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->filter(function ($instance) {

                if (!empty(request()->get('search')['value'])) {
                    $instance->where(function($w){
                        $search = request()->get('search')['value'];
                        $w->orWhere('ins', 'LIKE', "%$search%")
                           ->orWhere('id', 'LIKE', "%$search%");
                    });
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SelectedInstitution $model
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
            ->setTableId('dashboard-datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)

            ->parameters([
                'dom' => 'lBfrtip',
                "pageLength"=> "25",
                'responsive' => true,
                'autoWidth' => false,
                "sScrollX"=> "100%",
                    "bScrollCollapse"=> true,
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

            Column::make('DT_RowIndex','id')->title('ক্রম'),
            Column::make('division','division')->title('বিভাগ'),
            Column::make('district','district')->title('জেলা'),
            Column::make('constituency','parliamentary_constituency')->title('নির্বাচনী এলাকা'),
            Column::make('upazila','upazila')->title('উপজেলা'),
            Column::make('ins','institution_bn')->title('শিক্ষা প্রতিষ্ঠান'),
            Column::make('profile.head_name','profile.head_name')->title('প্রতিষ্ঠান প্রধান'),
            Column::make('contact','profile.institution_tel')->title('যোগাযোগ'),
            Column::make('profile.institution_email','profile.institution_email')->title('ইমেইল')
            /*Column::computed('action')
                ->exportable(false)
                ->printable(false)
                //->width(60)
                ->addClass('details-control'),*/
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SelectedInstitutions_' . date('YmdHis');
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
            return $data->with('profile')->where('status',"YES")->orderByRaw(" division,district,seat_no asc, FIELD(lab_type , 'sof') DESC,upazila ASC");
            //return $this->applyScopes($data);
        }
         return $data->with('profile')->where('status',"YES")->latest('id');
        //return $this->applyScopes($data);
    }
}
