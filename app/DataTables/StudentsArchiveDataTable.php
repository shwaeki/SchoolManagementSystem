<?php

namespace App\DataTables;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentsArchiveDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                return '<a href="' . route('students.show', $query) . '" class="btn btn-light-primary text-primary"><i class="far fa-eye"></i></a>
                    <button class="btn btn-light-success text-success" onclick="restoreItem(this)"
                    data-item="' . route('students.restore', $query) . '"><i class="fas fa-arrow-left-rotate"></i></button>';
            })->editColumn('gender', function ($query) {
                if ($query->gender === 'female')
                    return '<span class="badge badge-light-danger">انثى</span>';
                else
                    return '<span class="badge badge-light-info">ذكر</span>';
            })->editColumn('name', function ($query) {
                return '<img src="' . $query->photo . '" class="me-2 rounded-circle border border-primary" style="object-fit: contain;" width="50px" height="50px">' . $query->name;

            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'name', 'gender']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Student $model): QueryBuilder
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
                'name' => ['title' => 'الاسم '],
                'identification' => ['title' => 'رقم الهوية'],
                'mother_phone' => ['title' => 'رفم هاتف الام'],
                'father_phone' => ['title' => 'رقم هاتف الاب'],
                'gender' => ['title' => 'الجنس '],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Students_' . date('YmdHis');
    }
}
