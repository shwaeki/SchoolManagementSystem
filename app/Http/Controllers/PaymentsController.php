<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Http\Requests\StorePaymentsRequest;
use App\Http\Requests\UpdatePaymentsRequest;
use App\Models\Student;
use App\Models\StudentClass;
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

        DB::Transaction(function () {
            $student_id = request('student_id');
            $student = Student::findOrFail($student_id);

            $student->payments()->create([
                'payment_for' => request('payment_for'),
                'payment_way' => request('payment_way'),
                'amount' => request('amount'),
                'amount_before' => $student->balance,
                'amount_after' => $student->balance - request('amount'),
                'student_id' => request('student_id'),
                'academic_year_id' => getUserActiveAcademicYearID(),
                'payment_date' => request('payment_date'),
                'added_by' => auth()->id(),
            ]);

            $student->update([
                'balance' => $student->balance - request('amount'),
            ]);



            $current_student_class = $student->studentClasses()->whereHas('yearClass', function ($query)  {
                $query->where('academic_year_id', getAdminActiveAcademicYearID());
            })->get()->first();



            $mother_phone = $student->mother_phone;
            $father_phone = $student->father_phone;

            $amount = request('amount');
            $student_name = $student->name;
            $grade = $current_student_class?->yearClass?->schoolClass?->name ?? '';
            $purpose = request('payment_for');

            $message = "حضرة أولياء الأمور الكرام،
نود إعلامكم بأنه تم استلام دفعة بقيمة $amount بنجاح لتسديد المستحقات المالية لابنكم/ابنتكم $student_name من صف $grade. وذلك عن ($purpose).
نشكركم على حسن تعاونكم.
يرجى العلم أن هذه الرسالة تأكيد فقط على استلام الدفعة، وفي حال وجود أي استفسار أو حاجة لمزيد من التفاصيل، يمكنكم التواصل مع إدارة الروضة.

مع أطيب التحيات،
إدارة الروضة
";

            if ($mother_phone != null) {
                sendSms($message, $mother_phone, $student_name);
            }

            if ($father_phone != null && $mother_phone != $father_phone) {
                sendSms($message, $father_phone, $student_name);
            }
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
