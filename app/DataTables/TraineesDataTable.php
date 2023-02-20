<?php

namespace App\DataTables;

use App\Models\Application;
use App\Models\Dashboard;
use App\Models\Device;
use App\Models\Lab;
use App\Models\Trainee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TraineesDataTable extends DataTable
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
//                          $w->orWhere('institution', 'LIKE', "%$search%");
                        $w->whereHas('lab', function ($query) use ($search) {
                            $query->where('labs.institution', $search);
                        })
                            ->orWhere('mobile', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%")
                            ->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('designation', 'LIKE', "%$search%");
                    });
                }
            })
            ->addColumn('action', function ($query) {
                $ticketEdit= '<a href="#" onclick="editTicket('.$query->lab_id.','.$query->id.')" class="btn btn-default btn-xs"><i class="fas fa-ticket-alt"></i></a>';
                $ticketSolve= '<input type="number" class="batch" name="batch" min="1" max="201" value="'.$query->batch.'" data-trainee="'.$query->id.'">';

                if (Auth::user()->hasRole(['super admin']))
                    return $ticketEdit.$ticketSolve;
                if (Auth::user()->hasRole(['vendor']))
                    return $ticketSolve;
                if (Auth::user()->hasRole(['district admin','upazila admin']))
                    return $ticketEdit;
            })
            ->rawColumns([
                'action'
            ]);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SelectedInstitution $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $request)
    {
        //dd($request->all());
        $data=$this->getAppData($request);
        return $data;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('trainees-datatable')
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
        $location=[
            Column::make('lab.phase','phase')->title('পর্যায়'),
            Column::make('lab.division','division')->title('বিভাগ'),
            Column::make('lab.district','district')->title('জেলা'),
            Column::make('lab.upazila','upazila')->title('উপজেলা'),
            Column::make('lab.ins','institution_bn')->title('শিক্ষা প্রতিষ্ঠান'),
        ];
        $main= [
            Column::make('name','name')->title('নাম '),
            Column::make('designation','designation')->title('পদবি'),
            Column::make('mobile','mobile')->title('মোবাইল'),
            //Column::make('email','email')->title('ইমেইল'),
            Column::make('id','id')->title('আইডি#'),
            Column::make('batch','batch')->title('ব্যাচ#'),
            Column::make('created_at','created_at')->title('রেজিস্ট্রেশনের তারিখ')
        ];
        if (Auth::user()->hasRole(['vendor','super admin','district admin','upazila admin'])) {
            return array_merge($serial, $action, $location,$main);
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
        $data = Trainee::query();
        if (!empty($request->get('filter'))) {

            if (!empty($request->get('lab_id'))) {
                $data->where('lab_id', $request->get('lab_id'));
            }
            if (!empty($request->get('name'))) {
                $data->where('name', $request->get('name'));
            }
            if (!empty($request->get('designation'))) {
                $data->where('designation', $request->get('designation'));
            }
            if (!empty($request->get('mobile'))) {
                $data->where('mobile', $request->get('mobile'));
            }
            if (!empty($request->get('email'))) {
                $data->where('email', $request->get('email'));
            }
            if (!empty($request->get('phase'))) {
                $data->whereHas('lab', function ($query) use ($request) {
                    $query->where('labs.phase', $request->input('phase'));
                });
            }
            if (!empty($request->get('divId'))) {
                $data->whereHas('lab', function ($query) use ($request) {
                    $query->where('labs.division', $request->input('divId'));
                });
            }

            if (!empty($request->get('disId'))) {
                $data->whereHas('lab', function ($query) use ($request) {
                    $query->where('labs.district', $request->input('disId'));
                });
            }

            if (!empty($request->get('upazilaId'))) {
                $data->whereHas('lab', function ($query) use ($request) {
                    $query->where('labs.upazila', $request->input('upazilaId'));
                });
            }
            if (!empty($request->get('lab_type'))) {
                $data->whereHas('lab', function ($query) use ($request) {
                    $query->where('labs.lab_type', $request->input('lab_type'));
                });
            }
            return $data->with('lab')->permitted($request);
        }
        return $data->with('lab')->permitted($request);
    }
}
