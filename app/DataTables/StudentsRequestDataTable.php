<?php

namespace App\DataTables;

use App\Models\Student;
use App\Models\StudentRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentsRequestDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                return '<a href="' . route('students-request.show', $query) . '" class="btn btn-light-primary text-primary"><i class="far fa-eye"></i></a>
                    <a href="' . route('students-request.edit', $query) . '" class="btn btn-light-warning text-warning  d-none"><i class="far fa-edit"></i></a>
                    <button class="btn btn-light-danger text-danger  d-none" onclick="deleteItem(this)"
                    data-item="' . route('students-request.destroy', $query) . '"><i class="far fa-trash-alt"></i></button>';
            })
            ->editColumn('gender', function ($query) {
                if ($query->gender === 'female')
                    return '<span class="badge badge-light-danger">انثى</span>';
                else
                    return '<span class="badge badge-light-info">ذكر</span>';
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y');
            })

            ->editColumn('school_class_id ', function ($query) {
                return $query->schoolClass->name .' - '.$query->schoolClass->address;
            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'gender']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(StudentRequest $model): QueryBuilder
    {

        $quere = $model->newQuery();

        if (request('c') && request('c') != ""){
            $quere->where('school_class_id','=',$quere);
        }

        return $quere;
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
                'initComplete' =>
                    "function (settings, data) {
                        var class_col = this.api().columns(5);
                        $('#class').on('change', function () {
                            if( $(this).val() == null || $(this).val() == '')
                                class_col.search('').draw();
                            else
                                class_col.search($(this).val()).draw();
                        });
                    }",
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
                'school_class_id ' => ['title' => 'الفرع '],
                'created_at' => ['title' => 'تاريخ تقديم الطلب'],
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
