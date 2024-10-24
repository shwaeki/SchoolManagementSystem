<?php

namespace App\DataTables;


use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                $buttons = '';

                if (auth()->user()->can('update-role')) {
                    $buttons .= '<a href="' . route('roles.edit', $query) . '" class="btn btn-light-warning text-warning"><i class="far fa-edit"></i></a>';
                }

                if (auth()->user()->can('destroy-role')) {
                    $buttons .= '<button class="btn btn-light-danger text-danger  d-none" onclick="deleteItem(this)"
                                    data-item="' . route('roles.destroy', $query) . '"><i class="far fa-trash-alt"></i></button>';
                }

                return $buttons;

            })/*->addColumn('permissions', function ($query) {
                $permissions = "";
                foreach ($query->getAllPermissions() as $permission) {
                    $permissions .= ' <span class="badge badge-light-primary">' . $permission->name . '</span>';
                }
                return $permissions;
            })*/
            ->setRowId('id')
            ->rawColumns(['Settings','permissions']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
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
            ->setTableId('roles-table')
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
              /*  'permissions' => ['title' => 'الصلاحيات '],*/
                'Settings' => ['title' => 'خيارات', 'orderable' => false],

            ];


    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Roles_' . date('YmdHis');
    }
}
