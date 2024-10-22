<?php

namespace App\DataTables;

use App\Models\Application;
use App\Models\Dashboard;
use App\Models\Device;
use App\Models\Lab;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketDataTable extends DataTable
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
                            ->orWhere('device', 'LIKE', "%$search%")
                            ->orWhere('device_status', 'LIKE', "%$search%")
                            ->orWhere('support_status', 'LIKE', "%$search%");
                        });
                    }
                })
                ->addColumn('action', function ($query) {
                    $ticketEdit= '<a href="#" onclick="editTicket('.$query->lab_id.','.$query->id.')" class="btn btn-default btn-xs"><i class="fas fa-ticket-alt"></i></a>';
                    $ticketSolve= '<a href="#" onclick="showTicket('.$query->lab_id.','.$query->id.')" class="btn btn-default btn-xs"><i class="fas fa-headset"></i></a>';

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
            ->setTableId('ticket-datatable')
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

            Column::make('device','device')->title('ডিভাইসের ধরণ'),
            Column::make('device_status','device_status')->title('ডিভাইস স্ট্যাটাস'),
            Column::make('quantity','quantity')->title('মোট সংখ্যা'),
            Column::make('support_status','support_status')->title('অভিযোগের অবস্থা'),
            Column::make('created_at','created_at')->title('created_at')
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
        $data = Device::query();
        if (!empty($request->get('filter'))) {

            if (!empty($request->get('lab_id'))) {
                $data->where('lab_id', $request->get('lab_id'));
            }
            if (!empty($request->get('device_type'))) {
                $data->where('device', $request->get('device_type'));
            }
            if (!empty($request->get('device_status'))) {
                $data->where('device_status', $request->get('device_status'));
            }
            if (!empty($request->get('support_status'))) {
                $data->where('support_status', $request->get('support_status'));
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
            return $data->with('lab')->permitted($request)->orderByRaw(" created_at asc, FIELD(support_status , 'open','processing','resolved','unresolved') asc");
            //return $this->applyScopes($data);
        }
//        return $data->where('lab_id', $request->get('lab_id'))->with('lab');
        return $data->with('lab')->permitted($request)->orderByRaw(" created_at asc, FIELD(support_status , 'open','processing','resolved','unresolved') asc");
        //return $this->applyScopes($data);
    }
}
