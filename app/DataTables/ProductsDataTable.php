<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use DNS1D;
use DNS2D;

use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('Settings', function ($query) {
                return '<a href="' . route('products.show', $query) . '" class="btn btn-light-primary text-primary"><i class="far fa-eye"></i></a>
                    <a href="' . route('products.edit', $query) . '" class="btn btn-light-warning text-warning"><i class="far fa-edit"></i></a>';
            })
            ->editColumn('barcode', function ($query) {
                return '<div class="download_barcode d-inline-block" style="cursor: pointer;"
                        data-name="'.$query->name.'">
                    <div class="align-items-md-center d-flex flex-column px-3">
                    <p class="mb-0 text-black" style="line-height: 14px;word-wrap: normal; letter-spacing: normal;">'.$query->name.'</p>
                    <p class="mb-0 text-black">Price: '.$query->price.'₪</p>
                    '.DNS1D::getBarcodeHTML($query->barcode, "C128") .'
                    <p class="mb-0 text-black small">'.$query->barcode.'</p>
                </div></div>';
            })->editColumn('status', function ($query) {
                if ($query->status)
                    return '<span class="badge badge-light-info"> فعال</span>';
                else
                    return '<span class="badge badge-light-danger">غير فعال</span>';

            })
            ->setRowId('id')
            ->rawColumns(['Settings', 'status', 'barcode']);

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
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
            ->setTableId('Products-table')
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
                'name' => ['title' => 'التاريخ'],
                'price' => ['title' => 'السعر'],
                'barcode' => ['title' => 'الباركود'],
                'category' => ['title' => 'التصنيف'],
                'status' => ['title' => 'الحالة '],
                'Settings' => ['title' => 'خيارات', 'orderable' => false],
            ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
