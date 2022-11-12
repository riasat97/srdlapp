<?php

namespace App\DataTables;

use App\Models\Application;
use App\Models\Dashboard;
use App\Models\Lab;
use App\Models\Notice;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NoticeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        if(!empty(Auth::user()) && Auth::user()->hasRole(['super admin'])){
            return datatables()
                ->eloquent($query)
                ->addIndexColumn()
                ->filter(function ($instance) {

                    if (!empty(request()->get('search')['value'])) {
                        $instance->where(function($w){
                            $search = request()->get('search')['value'];
                            $w->orWhere('title', 'LIKE', "%$search%");
                        });
                    }
                })
                ->addColumn('download', function ($query) {
                    $html='';
                    foreach ($query->attachments as $attachment){
                        $html.='<a href='.$attachment->file.' target="_blank"> <i class="glyphicon glyphicon-save-file"></i></a>';
                    }
                    return $html;
                })
                ->addColumn('action', function ($query) {
                    $html='';
                    $html.='<form action='.route("notices.destroy", $query->id).' method="POST" >';
        $html.='<input type="hidden" name="_method" value="DELETE">';
        $html.='<input type="hidden" name="_token" value="'.csrf_token().'">';
        $html.='<button type="submit" class="btn btn-danger btn-xs" onclick="return Conform_Delete()"><i class="glyphicon glyphicon-trash"></i> </button>';
        $html.='</form>';
                    return $html;
                    //return  '<a href='.route('notices.show', $query->id).' class="btn btn-danger btn-xs" onclick="return Conform_Delete()"><i class="glyphicon glyphicon-trash" ></i></a>';
                })
                ->rawColumns([
                    'download','action'
                ]);
        }
        else{
            return datatables()
                ->eloquent($query)
                ->addIndexColumn()
                ->filter(function ($instance) {

                    if (!empty(request()->get('search')['value'])) {
                        $instance->where(function($w){
                            $search = request()->get('search')['value'];
                            $w->orWhere('title', 'LIKE', "%$search%");
                        });
                    }
                })
                ->addColumn('download', function ($query) {
                    $html='';
                    foreach ($query->attachments as $attachment){
                        $html.='<a href='.$attachment->file.' target="_blank"> <i class="glyphicon glyphicon-save-file"></i></a>';
                    }
                    return $html;
                })
                ->rawColumns([
                    'download'
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
        return $data=$this->getAppData($request);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('notice-datatable')
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
               // "scrollX"=> true,
              //  "scrollY"=> "400px",
                "scrollCollapse"=> true,
                //"fixedColumns"=>['left'=>3],
                'buttons' => [ 'reload'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if(!empty(Auth::user()) && Auth::user()->hasRole(['super admin'])){
            return [
                Column::make('DT_RowIndex','id')->title('SL.'),
                Column::make('title','title')->title('Title'),
                Column::make('published_at','published_at')->title('Publish Date'),
                Column::computed('download')->title('Download'),
                Column::computed('action')->title('Action')
                    ->exportable(false)
                    ->printable(false)
                    ->orderable(false)
                    ->searchable(false),
            ];
        }
        else{
            return [
                Column::make('DT_RowIndex','id')->title('SL.'),
                Column::make('title','title')->title('Title'),
                Column::make('published_at','published_at')->title('Publish Date'),
                Column::computed('download')->title('Download'),
            ];
        }
    }

    /**
     * Get filename for export.
     *
     * @return string
     */

    protected function getAppData(Request $request)
    {
        $data = Notice::query();
        $data->with('attachments')->where('published_at', '<', now())->orderByDesc('published_at');
        return $this->applyScopes($data);
    }
}
