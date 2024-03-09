<?php

namespace App\DataTables;


use App\Models\Report;
use App\Models\StudentReport;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                return '<a href="' . route('reports.edit', $query) . '" class="btn btn-light-warning text-warning"><i class="far fa-edit"></i></a>
                    <button class="btn btn-light-danger text-danger  d-none" onclick="deleteItem(this)"
                    data-item="' . route('reports.destroy', $query) . '"><i class="far fa-trash-alt"></i></button>';
            })
            ->editColumn('added_by', function ($query) {
                return $query->addedBy?->name;
            })->editColumn('type', function ($query) {
                return __('options.'.$query->type);
            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'gender']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Report $model): QueryBuilder
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
            ->setTableId('students-table')
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
                'name' => ['title' => 'اسم التقرير '],
                'subject' => ['title' => 'عنوان التقرير '],
                'type' => ['title' => 'النوع'],
                'added_by' => ['title' => 'اضيف بواسطة'],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Reports_' . date('YmdHis');
    }
}
