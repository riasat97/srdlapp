<?php

namespace App\DataTables;

use App\Models\Application;
use App\Models\Dashboard;
use App\Models\Lab;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OwnLabsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        if (Auth::user()->hasRole(['super admin','upazila admin','district admin','vendor'])) {
            return datatables()
                ->eloquent($query)
                ->addIndexColumn()
                ->filter(function ($instance) {

                    if (!empty(request()->get('search')['value'])) {
                        $instance->where(function($w){
                            //dd(request()->all());
                            $search = request()->get('search')['value'];
                            $w->orWhere('institution', 'LIKE', "%$search%");
                            //->orWhere('stock.contract', 'LIKE', "%$search%");
                        });
                    }
                })
                ->addColumn('action', function ($query) {

                    return '<a href="'.route("labs.supports.index",$query->id) .'" data-toggle="tooltip" title="Support" target="_blank" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-wrench"></i></a>';
                })

                ->rawColumns([
                    'action'
                ]);
        }
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
        $serial=[ Column::make('DT_RowIndex','id')->title('ক্রম')];
        $action= [Column::computed('action')
            ->title('Action')
            ->exportable(false)
            ->printable(false)
            ->orderable(false)
            ->searchable(false)
        ];

        $main= [
            Column::make('phase','phase')->title('পর্যায়'),
            Column::make('division','division')->title('বিভাগ'),
            Column::make('district','district')->title('জেলা'),
            Column::make('constituency','parliamentary_constituency')->title('নির্বাচনী এলাকা'),
            Column::make('upazila','upazila')->title('উপজেলা'),
            Column::make('ins','institution_bn')->title('শিক্ষা প্রতিষ্ঠান'),
            Column::make('head_name','head_name')->title('প্রতিষ্ঠান প্রধান'),
            Column::make('tel','institution_tel')->title('যোগাযোগ'),
            Column::make('institution_email','institution_email')->title('ইমেইল')
        ];
        if (Auth::user()->hasRole(['super admin','upazila admin','district admin'])) {
            return array_merge($serial, $action, $main);
        }
        return array_merge($serial,$main);

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Labs_' . date('YmdHis');
    }

    protected function getAppData(Request $request)
    {
        //dd(empty($request->get('upazilaId')));
        $data = Lab::query();
        if (!empty($request->get('filter'))) {
            if (!empty($request->get('phase'))) {
                $data->where('phase', $request->get('phase'));
            }
            if (!empty($request->get('divId'))) {
                $data->where('division', $request->get('divId'));
            }

            if (!empty($request->get('disId'))) {
                $data->where('district', $request->get('disId'));
            }
            if (!empty($request->get('parliamentaryConstituencyId'))) {
                $data->where('parliamentary_constituency', $request->get('parliamentaryConstituencyId'));
            }
            if (!empty($request->get('upazilaId'))) {
                $data->where('upazila', $request->get('upazilaId'));
            }
            if (!empty($request->get('lab_type'))) {
                $data->where('lab_type', $request->get('lab_type'));
            }
            // dd($data->get()->toArray());
            return $data->permitted(null)->orderByRaw(" phase DESC, division,district,seat_no_en asc, FIELD(lab_type , 'srdl_sof','sof','srdl'),upazila ASC");
            //return $this->applyScopes($data);
        }
        return $data->permitted(null)->orderByRaw("phase DESC, division,district,seat_no_en asc, FIELD(lab_type , 'srdl_sof','sof','srdl'),upazila ASC");
        //return $this->applyScopes($data);
    }
}
