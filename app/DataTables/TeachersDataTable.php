<?php

namespace App\DataTables;


use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class TeachersDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                $buttons = '';
                if (auth()->user()->can('view-teacher')) {
                    $buttons .= '<a href="' . route('teachers.show', $query) . '" class="btn btn-light-primary text-primary"><i class="far fa-eye"></i></a>';
                }
                if (auth()->user()->can('update-teacher')) {
                    $buttons .= '<a href="' . route('teachers.edit', $query) . '" class="btn btn-light-warning text-warning"><i class="far fa-edit"></i></a>';
                }
                if (auth()->user()->can('archive-teacher')) {
                    $buttons .= '<button class="btn btn-light-secondary text-secondary" onclick="archiveItem(this)"
                    data-item="' . route('teachers.archive', $query) . '"><i class="fas fa-archive"></i></button>';
                }
                if (auth()->user()->can('destroy-teacher')) {
                    $buttons .= ' <button class="btn btn-light-danger text-danger  d-none" onclick="deleteItem(this)"
                    data-item="' . route('teachers.destroy', $query) . '"><i class="far fa-trash-alt"></i></button>';
                }
                return $buttons;

            })->editColumn('gender', function ($query) {
                if ($query->gender === 'female')
                    return '<span class="badge badge-light-danger">انثى</span>';
                else
                    return '<span class="badge badge-light-info">ذكر</span>';
            })->editColumn('status', function ($query) {
                return trans('options.' . $query->status);
            })->editColumn('teacher_type', function ($query) {
                return trans('options.' . $query->teacher_type . '_badge');
            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'teacher_type', 'gender']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Teacher $model): QueryBuilder
    {
        return $model->newQuery()->where('archived', false);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('teachers-table')
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
                'name' => ['title' => 'الاسم '],
                'identification' => ['title' => 'رقم الهوية'],
                'phone' => ['title' => 'رفم الهاتف '],
                'birth_date' => ['title' => 'تاريخ الميلاد'],
                'gender' => ['title' => 'الجنس '],
                'star_work_date' => ['title' => 'تاريخ بدأ العمل '],
                'teacher_type' => ['title' => 'النوع '],
                'status' => ['title' => 'الحالة '],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Teachers_' . date('YmdHis');
    }
}
