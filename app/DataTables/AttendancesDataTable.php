<?php

namespace App\DataTables;


use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class AttendancesDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                $buttons = '';

                if (auth()->user()->can('update-teachers-attendance')) {
                    $buttons .= '<button type="button" class="btn btn-light-warning text-warning edit-attendance"
                            data-date="' . $query->date . '"
                            data-check_in="' . $query->check_in?->format('h:i') . '"
                            data-check_out="' . $query->check_out?->format('h:i') . '"
                            data-id="' . $query->id . '" data-bs-toggle="modal" data-bs-target="#editAttendanceModal"><i class="far fa-edit"></i></button>';
                }

                return $buttons;
            })
            ->editColumn('teacher_id', function ($query) {
                return $query->teacher->name;
            })
            ->setRowId('id')
            ->rawColumns(['Settings']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Attendance $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('attendances-table')
            ->parameters([
                'lengthMenu' => [
                    [50, 75, 100, 150, -1],
                    ['50 ', '75', '100', '150', 'الجميع']
                ],

                'buttons' => [
                    "excel", 'print'
                ],
            ])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center align-items-center'lB><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>
                    <'table-responsive-sm'tr>
                    <'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>")
            ->language(asset('assets/datatable_arabic.json'))
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */

    protected function getColumns()
    {
        return
            [
                'teacher_id' => ['title' => 'الموظف '],
                'date' => ['title' => 'التاريخ'],
                'check_in' => ['title' => 'وقت الوصول'],
                'check_out' => ['title' => 'وقت الخروج'],
                'total_hours' => ['title' => 'مجموع الساعات'],

                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'attendances_' . date('YmdHis');
    }
}
