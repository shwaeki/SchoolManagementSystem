<?php

namespace App\DataTables;


use App\Models\AcademicYear;
use App\Models\Certificate;
use App\Models\SalarySlipFile;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class SalariesDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                if ($query->status != 'done') {
                    return '<button class="btn btn-light-primary text-primary" onclick="updateSalaryFile(this)"
                            data-item="' . route('salaries.update', $query) . '"><i class="far fa-file-archive"></i></button>';
                } else {
                    return '';
                }
            })->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d');
            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'status']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(SalarySlipFile $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->parameters([
                'lengthMenu' => [
                    [50, 75, 100, 150, -1],
                    ['50 ', '75', '100', '150', 'الجميع'],
                ],

                'buttons' => [
                    "excel", 'print',
                ],
            ])
            ->setTableId('SalarySlipFile-table')
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
                'date' => ['title' => 'التاريخ '],
                'status' => ['title' => 'الحالة '],
                'created_at' => ['title' => 'تاريخ الاضافة '],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SalarySlipFile_' . date('YmdHis');
    }
}
