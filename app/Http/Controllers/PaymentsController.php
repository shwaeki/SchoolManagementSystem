<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Http\Requests\StorePaymentsRequest;
use App\Http\Requests\UpdatePaymentsRequest;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
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
    public function store(StorePaymentsRequest $request)
    {




        DB::Transaction(function (){
            $student_id = request('student_id');
            $student = Student::findOrFail($student_id);

           $text = $student->payments()->create([
                'payment_way' => request('payment_way'),
                'amount' => request('amount'),
                'amount_before' => $student->balance,
                'amount_after' => $student->balance - request('amount'),
                'student_id' => request('student_id'),
                'payment_date' => request('payment_date'),
                'added_by' => auth()->id(),
            ]);

            $student->update([
                'balance' => $student->balance - request('amount'),
            ]);
        });

        Session::flash('message', 'تمت عملية الشراء بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentsRequest $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
