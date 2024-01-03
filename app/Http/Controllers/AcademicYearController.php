<?php

namespace App\Http\Controllers;

use App\DataTables\AcademicYearDataTable;
use App\Models\academicYear;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Requests\UpdateAcademicYearRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AcademicYearController extends Controller
{

    public function index(AcademicYearDataTable $dataTable)
    {
        return $dataTable->render('academicYear.index');
    }


    public function create()
    {

        return view('academicYear.create');
    }


    public function store(StoreAcademicYearRequest $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        if (request('status') === "1") {
            AcademicYear::where('status', true)->update(['status' => false]);
        }

        AcademicYear::create($data);
        Session::flash('message', 'تم اضافة معلم جديد بنجاح.');

        return redirect()->route('academic-years.index');
    }


    public function show(AcademicYear $academicYear)
    {

    }


    public function edit(AcademicYear $academicYear)
    {
        $data = [
            "academicYear" => $academicYear,
        ];

        return view('academicYear.edit', $data);
    }


    public function update(UpdateAcademicYearRequest $request, AcademicYear $academicYear)
    {

        if (request('status') === "0") {
            return back()->withErrors(['status' => ['يجب ان يكون هناك سنة دراسية واحدة على الاقل فعالة.']]);
        }

        AcademicYear::where('status', true)->where('id', '!=', $academicYear->id)->update(['status' => false]);

        $academicYear->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات السنة الدراسية بنجاح.');
        return redirect()->route('academic-years.index');
    }


    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        Session::flash('message', 'تم حذف السنة الدراسية بنجاح!');
        return redirect()->route('academic-years.index');
    }

    public function selectAcademicYear(Request $request)
    {
        $year = AcademicYear::findOrFail(request('year'));
        Session::put('activeAcademicYear', $year);
        return redirect()->back();
    }
}
