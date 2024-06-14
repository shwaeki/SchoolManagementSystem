<?php

namespace App\Http\Controllers;

use App\DataTables\TeachersDataTable;
use App\DataTables\WorkersDataTable;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Report;
use App\Models\SalarySlip;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class WorkerController extends Controller
{

    public function index(WorkersDataTable $dataTable)
    {
        return $dataTable->render('worker.index');
    }

    public function create()
    {
        $data = [
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('worker.create', $data);
    }


    public function store(StoreWorkerRequest $request)
    {
        $addedData = [
            'teacher_type' => 'worker',
            'added_by' => auth()->id(),
        ];


        $data = request()->all() + $addedData;

        $date1 = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date1));

        $date2 = str_replace('/', '-', request('star_work_date'));
        $data['star_work_date'] = date('Y-m-d', strtotime($date2));

        $data['password'] = Hash::make(request('password'));
        $worker = Teacher::create($data);

        if ($request->hasFile('id_photo')) {
            $extension = $request->file('id_photo')->getClientOriginalExtension();
            $fileNameToStore = " صورة الهوية" . '.' . $extension;
            $request->file('id_photo')->storeAs("public/files/Teacher_" . $worker->id, $fileNameToStore);
        }


        Session::flash('message', 'تم اضافة موظف جديد بنجاح.');
        return redirect()->route('workers.index');
    }


    public function show(Teacher $worker)
    {
        $data = [
            "salaries" => SalarySlip::where('identification', $worker->identification)->get(),
            "worker" => $worker,
            "reports" => Report::where('type','teacher')->get(),
            "teacher_reports" => $worker->reports,
        ];

        Session::put('fileManagerConfig', "Teacher_" . $worker->id);
        return view('worker.show', $data);
    }


    public function edit(Teacher $worker)
    {
        $data = [
            "worker" => $worker,
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('worker.edit', $data);
    }


    public function update(UpdateWorkerRequest $request, Teacher $worker)
    {

        $data = request()->all();

        $date1 = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date1));

        $date2 = str_replace('/', '-', request('star_work_date'));
        $data['star_work_date'] = date('Y-m-d', strtotime($date2));


        $worker->update($data);
        Session::flash('message', 'تم تعديل معلومات الموظف بنجاح.');
        return redirect()->route('workers.show', $worker);
    }


    public function destroy(Teacher $worker)
    {
        $worker->delete();
        Session::flash('message', 'تم حذف المعلم بنجاح!');
        return redirect()->route('workers.index');
    }

    public function passwordUpdate(Request $request, Teacher $worker)
    {

        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);


        $worker->update(['password' => Hash::make($request->new_password)]);
        Session::flash('message', 'تم تعديل كلمة المرور  بنجاح.');
        return redirect()->route('workers.show', $worker);
    }


    public function downloadSlip(SalarySlip $salarySlip)
    {
        $path = public_path('storage/' . $salarySlip->file_path);
        return response()->file($path);
    }
}
