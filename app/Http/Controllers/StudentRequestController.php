<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsRequestDataTable;
use App\Models\Student;
use App\Models\StudentRequest;
use App\Http\Requests\UpdateStudentRequestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class StudentRequestController extends Controller
{
    public function index(StudentsRequestDataTable $dataTable)
    {
        return $dataTable->render('studentRequest.index');
    }


    public function show(StudentRequest $students_request)
    {

        $data = [
            "studentRequest" => $students_request,
        ];
        Session::put('fileManagerConfig', "StudentRequest_" . $students_request->id);
        return view('StudentRequest.show', $data);
    }


    public function edit(StudentRequest $students_request)
    {
        $data = [
            "studentRequest" => $students_request,
        ];

        return view('StudentRequest.edit', $data);
    }


    public function update(UpdateStudentRequestRequest $request, StudentRequest $students_request)
    {
        $all_data = request()->all();
        $date = str_replace('/', '-', request('birth_date'));
        $all_data['birth_date'] = date('Y-m-d', strtotime($date));


        $students_request->update($all_data);
        Session::flash('message', 'تم تعديل معلومات الطلب بنجاح.');
        return redirect()->route('students-request.show', $students_request);
    }

    public function accept(Request $request, StudentRequest $students_request)
    {

        $all_data = $students_request->toArray();

        $isUnique = Student::where('identification', $all_data['identification'])->get();


        if (count($isUnique) > 0) {
            $validator = Validator::make([], []); // Create an empty validator
            $validator->errors()->add('identification', 'The identification is already in the system.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Arr::except($all_data, ['id', 'created_at', 'updated_at']);
        $data['added_by'] = auth()->id();

        $student = Student::create($data);

        $oldPath = "public/files/StudentRequest_" . $all_data['id'];
        $newPath = "public/files/Student_" . $student->id;
        Storage::move($oldPath, $newPath);

        $students_request->delete();
        Session::flash('message', 'تم تسجيل الطلب بنجاح.');
        return redirect()->route('students.show', $student);
    }


    public function destroy(StudentRequest $students_request)
    {
        $students_request->delete();

        Session::flash('message', 'تم حذف الطلب بنجاح!');
        return redirect()->route('students-request.index');
    }
}
