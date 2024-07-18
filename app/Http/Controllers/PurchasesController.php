<?php

namespace App\Http\Controllers;

use App\Models\Purchases;
use App\Http\Requests\StorePurchasesRequest;
use App\Http\Requests\UpdatePurchasesRequest;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchasesRequest $request)
    {



        DB::Transaction(function () {
            $products = request('order');
            $student_id = request('student_id');
            $student = Student::findOrFail($student_id);

            foreach ($products as $product) {
                $student->purchases()->create([
                    'product_id' => $product['product'],
                    'price' => $product['price'],
                    'student_id' => request('student_id'),
                    'academic_year_id' => getUserActiveAcademicYearID(),
                    'added_by' => auth()->id(),
                ]);

                $student->update([
                    'balance' => $student->balance - $product['price'],
                ]);
            }
        });


        Session::flash('message', 'تمت عملية الشراء بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchases $purchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchasesRequest $request, Purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchases $purchases)
    {
        //
    }
}
