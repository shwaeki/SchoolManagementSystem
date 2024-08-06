<?php

namespace App\DataTables;


use App\Models\AcademicYear;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class ClassesArchiveDataTable extends DataTable
{

    private $activeAcademicYear;

    function __construct()
    {
        $this->activeAcademicYear = Session::get('activeAcademicYear');
    }

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                return '<a href="' . route('school-classes.show', $query) . '" class="btn btn-light-primary text-primary"><i class="far fa-eye"></i></a>
                    <button class="btn btn-light-success text-success" onclick="restoreItem(this)"
                    data-item="' . route('school-classes.restore', $query) . '"><i class="fas fa-arrow-left-rotate"></i></button>';
            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'YearCode']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(SchoolClass $model): QueryBuilder
    {
        return $model->newQuery()->where('archived',true);
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
                    "excel", 'print'
                ],

            ])
            ->setTableId('school-class-table')
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
                'phone' => ['title' => 'رقم الهاتف'],
                'capacity' => ['title' => 'الطاقة الاستيعابة'],
                'alphabetical_name' => ['title' => 'الكود الابجدي'],
                'address' => ['title' => 'العنوان'],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SchoolClass_' . date('YmdHis');
    }
}
