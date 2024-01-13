<?php

namespace App\Http\Controllers;

use App\DataTables\TeachersDataTable;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\SalarySlip;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{

    public function index(TeachersDataTable $dataTable)
    {
        return $dataTable->render('teacher.index');
    }

    public function create()
    {
        $data = [
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('teacher.create', $data);
    }


    public function store(StoreTeacherRequest $request)
    {
        $addedData = [
            'teacher_type' => 'teacher',
            'added_by' => auth()->id(),
            'work_afternoon' => request()->has('work_afternoon') ? 1 : 0,
        ];


        $data = request()->all() + $addedData;

        $date1 = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date1));

        $date2 = str_replace('/', '-', request('star_work_date'));
        $data['star_work_date'] = date('Y-m-d', strtotime($date2));

        $data['password'] = Hash::make(request('password'));
        $teacher = Teacher::create($data);

        if ($request->hasFile('id_photo')) {
            $extension = $request->file('id_photo')->getClientOriginalExtension();
            $fileNameToStore = " صورة الهوية" . '.' . $extension;
            $request->file('id_photo')->storeAs("public/files/Teacher_" . $teacher->id, $fileNameToStore);
        }


        Session::flash('message', 'تم اضافة معلم جديد بنجاح.');
        return redirect()->route('teachers.index');
    }


    public function show(Teacher $teacher)
    {
        $data = [
            "salaries" => SalarySlip::where('identification', $teacher->identification)->get(),
            "teacher" => $teacher,
        ];

        Session::put('fileManagerConfig', "Teacher_" . $teacher->id);
        return view('teacher.show', $data);
    }


    public function edit(Teacher $teacher)
    {
        $data = [
            "teacher" => $teacher,
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('teacher.edit', $data);
    }


    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {

        $addedData = [
            'work_afternoon' => request()->has('work_afternoon') ? 1 : 0,
        ];

        $data = request()->all() + $addedData;

        $date1 = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date1));

        $date2 = str_replace('/', '-', request('star_work_date'));
        $data['star_work_date'] = date('Y-m-d', strtotime($date2));


        $teacher->update($data);
        Session::flash('message', 'تم تعديل معلومات المعلم بنجاح.');
        return redirect()->route('teachers.show', $teacher);
    }


    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        Session::flash('message', 'تم حذف المعلم بنجاح!');
        return redirect()->route('teachers.index');
    }

    public function passwordUpdate(Request $request, Teacher $teacher)
    {

        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);


        $teacher->update(['password' => Hash::make($request->new_password)]);
        Session::flash('message', 'تم تعديل كلمة المرور  بنجاح.');
        return redirect()->route('teachers.show', $teacher);
    }


    public function downloadSlip(SalarySlip $salarySlip)
    {
        $path = public_path('storage/'.$salarySlip->file_path);
        return response()->download($path);
    }
}
