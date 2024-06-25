<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $all_data = request()->all();

        $data = $all_data + ['added_by' => auth()->id(),];
        Product::create($data);

        Session::flash('message', 'تم اضافة منتج جديد بنجاح.');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = [
            'product' => $product,
        ];
        return view('products.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = [
            'product' => $product,
        ];
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $addedData = [
            'status' => request()->has('status') ? 1 : 0,
        ];

        $data = request()->all() + $addedData;

        $product->update($data);
        Session::flash('message', 'تم تعديل معلومات المنتج بنجاح.');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function ajax(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $barcode = $request->barcode;
            if ($barcode) {
                $data = Product::select("id", "name", "barcode", "price")
                    ->where('status', true)
                    ->where('barcode', $barcode)
                    ->get();
            } else {
                $data = Product::select("id", "name", "barcode", "price")
                    ->where('status', true)
                    ->where('name', 'LIKE', "%$search%")
                    ->get();
            }
        }
        return response()->json($data);
    }

}
