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

class StockDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
    // dd($query->selectRaw('labs.*'));
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
                return '<a href="'.route("labs.stocks.edit", [$query->id,$query->stock->id]) .'" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>';
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
            ->setTableId('stock-datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)

            ->parameters([
                'dom' => 'lBfrtip',
                'columnDefs'=> [
                'targets'=> 1,
                'className'=> 'noVis',['width'=>200,'targets'=>1]],
                "pageLength"=> "10",
                'responsive' => true,
                'autoWidth' => true,
                "scrollX"=> true,
                "scrollY"=> "400px",
                "scrollCollapse"=> true,
                "fixedColumns"=>['left'=>3],
                'buttons' => [['extend'=>'colvis','columns'=>':not(.noVis)'],
                    ['extend' => 'excel',
                    'messageTop' => "SRDL Stocks"
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

            Column::make('DT_RowIndex','id')->title('SL.'),
            Column::computed('action')
                ->title('edit')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
            Column::make('ins','institution')->title('Institution'),
            Column::make('division','division')->title('Division'),
            Column::make('district','district')->title('District'),
            Column::make('upazila','upazila')->title('Upazila'),
            Column::make('stock.contract','contract')->title('Contract'),
            Column::make('stock.renovation','renovation')->title('Renovation'),
            Column::make('stock.networking','networking')->title('Networking'),
            Column::make('stock.furniture','furniture')->title('Furniture'),
            Column::make('stock.laptop','laptop')->title('Laptop'),
            Column::make('stock.printer','printer')->title('Printer'),
            Column::make('stock.scanner','scanner')->title('Scanner'),
            Column::make('stock.led_tv','led_tv')->title('LedTv'),
            Column::make('stock.router','router')->title('Router'),
            Column::make('stock.network_switch','network_switch')->title('Network-Switch'),
            Column::make('stock.webcam','webcam')->title('Web-Camera'),
            Column::make('stock.sof_contract','sof_contract')->title('SoF-Contract'),
            Column::make('stock.smart_board','smart_board')->title('Smart-Board'),
            Column::make('stock.desktop','desktop')->title('Desktop-Computer'),
            Column::make('stock.industrial_router','industrial_router')->title('Industrial-Router'),
            Column::make('stock.attendance_reader','attendance_reader')->title('Attendance-Reader'),
            Column::make('stock.digital_id_card','digital_id_card')->title('Digital-IdCard'),


                //->width(60)
                //->addClass('details-control'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Stocks_' . date('YmdHis');
    }

    protected function getAppData(Request $request)
    {
        //dd(empty($request->get('upazilaId')));
        $data = Lab::query();
        if (!empty($request->get('filter'))) {
            if (!empty($request->get('divId'))) {
                $data->where('division', $request->get('divId'));
            }

            if (!empty($request->get('disId'))) {
                $data->where('district', $request->get('disId'));
            }

            if (!empty($request->get('upazilaId'))) {
                $data->where('upazila', $request->get('upazilaId'));
            }

            if (!empty($request->get('lab_type'))) {
                $data->where('lab_type', $request->get('lab_type'));
            }

            // dd($data->get()->toArray());
             $data->with('stock')->where('phase',2)->orderByRaw(" division,district,upazila asc, FIELD(lab_type , 'sof') DESC");
            return $this->applyScopes($data);
        }
        //dd($data->get()->toArray());
         $data->with('stock')->where('phase',2)->permitted(null)->latest('id');
        return $this->applyScopes($data);
    }
}
