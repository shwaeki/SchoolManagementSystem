<?php

namespace App\Http\Controllers;

use App\Models\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentMarkController extends Controller
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
    public function store(Request $request)
    {
        // dd(\request()->all());

        $marks = request('marks');
        $student_class_year = request('student_class_year');


        foreach ($marks['first_semester'] as $id => $mark) {
            StudentMark::updateOrCreate(
                [
                    'certificate_category_id' => $id,
                    'student_class_id' => $student_class_year,
                    'semester' => 'first',
                ],[ "mark" => $mark]
            );
        }

        foreach ($marks['second_semester'] as $id => $mark) {
            StudentMark::updateOrCreate(
                [
                    'certificate_category_id' => $id,
                    'student_class_id' => $student_class_year,
                    'semester' => 'second',
                ],[ "mark" => $mark]
            );
        }
        Session::flash('message', 'تم تعديل شهادة الطالب بنجاح.');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(StudentMark $studentMark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentMark $studentMark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentMark $studentMark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentMark $studentMark)
    {
        //
    }
}
