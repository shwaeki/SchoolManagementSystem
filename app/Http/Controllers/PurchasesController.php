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

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

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


    public function show(Purchases $purchase)
    {
        //
    }


    public function edit(Purchases $purchase)
    {
        //
    }


    public function update(UpdatePurchasesRequest $request, Purchases $purchase)
    {
        //
    }


    public function destroy(Purchases $purchase)
    {
        $purchase->delete();
        Session::flash('message', 'تم حذف عملية الشراء بنجاح');
        return redirect()->back();
    }
}
