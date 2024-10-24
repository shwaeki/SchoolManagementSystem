<?php

namespace App\DataTables;


use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class AcademicYearDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                $buttons = '';

                if (auth()->user()->can('update-academic-year')) {
                    $buttons .= '<a href="' . route('academic-years.edit', $query) . '" class="btn btn-light-warning text-warning"><i class="far fa-edit"></i></a>';
                }

                if (auth()->user()->can('destroy-academic-year')) {
                    $buttons .= '<button class="btn btn-light-danger text-danger d-none" onclick="deleteItem(this)"
                    data-item="' . route('academic-years.destroy', $query) . '"><i class="far fa-trash-alt"></i></button>';
                }
                return $buttons;

            })->editColumn('status', function ($query) {
                if ($query->status)
                    return '<span class="badge badge-light-info"> فعال</span>';
                else
                    return '<span class="badge badge-light-danger">غير فعال</span>';

            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'status']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(AcademicYear $model): QueryBuilder
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
                    ['50 ', '75', '100', '150', 'الجميع']
                ],

                'buttons' => [
                    "excel",'print'
                ],
            ])
            ->setTableId('academic-years-table')
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
                'name' => ['title' => 'الاسم '],
                'start_date' => ['title' => 'تاريخ البدأ '],
                'end_date' => ['title' => 'تاريخ الانتهاء '],
                'status' => ['title' => 'الحالة '],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AcademicYears_' . date('YmdHis');
    }
}
