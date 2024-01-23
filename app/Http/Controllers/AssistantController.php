<?php

namespace App\Http\Controllers;

use App\DataTables\AssistantDataTable;
use App\Http\Requests\StoreAssistantRequest;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateAssistantRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\SalarySlip;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AssistantController extends Controller
{

    public function index(AssistantDataTable $dataTable)
    {
        return $dataTable->render('assistant.index');
    }

    public function create()
    {
        $data = [
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('assistant.create', $data);
    }


    public function store(StoreAssistantRequest $request)
    {
        $addedData = [
            'teacher_type' => 'assistant',
            'added_by' => auth()->id(),
            'work_afternoon' => request()->has('work_afternoon') ? 1 : 0,
        ];


        $data = request()->all() + $addedData;

        $date1 = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date1));

        $date2 = str_replace('/', '-', request('star_work_date'));
        $data['star_work_date'] = date('Y-m-d', strtotime($date2));

        $data['password'] = Hash::make(request('password'));
        $assistant = Teacher::create($data);

        if ($request->hasFile('id_photo')) {
            $extension = $request->file('id_photo')->getClientOriginalExtension();
            $fileNameToStore = " صورة الهوية" . '.' . $extension;
            $request->file('id_photo')->storeAs("public/files/Teacher_" . $assistant->id, $fileNameToStore);
        }


        Session::flash('message', 'تم اضافة مساعدة جديدة بنجاح.');
        return redirect()->route('assistants.index');
    }


    public function show(Teacher $assistant)
    {
        $data = [
                "salaries" => SalarySlip::where('identification', $assistant->identification)->get(),
            "teacher" => $assistant,
        ];

        Session::put('fileManagerConfig', "Teacher_" . $assistant->id);
        return view('assistant.show', $data);
    }


    public function edit(Teacher $assistant)
    {
        $data = [
            "teacher" => $assistant,
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('assistant.edit', $data);
    }


    public function update(UpdateAssistantRequest $request, Teacher $assistant)
    {

        $addedData = [
            'work_afternoon' => request()->has('work_afternoon') ? 1 : 0,
        ];

        $data = request()->all() + $addedData;

        $date1 = str_replace('/', '-', request('birth_date'));
        $data['birth_date'] = date('Y-m-d', strtotime($date1));

        $date2 = str_replace('/', '-', request('star_work_date'));
        $data['star_work_date'] = date('Y-m-d', strtotime($date2));


        $assistant->update($data);
        Session::flash('message', 'تم تعديل معلومات المساعدة بنجاح.');
        return redirect()->route('assistants.show', $assistant);
    }


    public function destroy(Teacher $assistant)
    {
        $assistant->delete();
        Session::flash('message', 'تم حذف المساعدة بنجاح!');
        return redirect()->route('assistants.index');
    }

    public function passwordUpdate(Request $request, Teacher $assistant)
    {

        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);


        $assistant->update(['password' => Hash::make($request->new_password)]);
        Session::flash('message', 'تم تعديل كلمة المرور  بنجاح.');
        return redirect()->route('assistants.show', $assistant);
    }

    public function downloadSlip(SalarySlip $salarySlip)
    {
        $path = public_path('storage/'.$salarySlip->file_path);
        return response()->file($path);
    }
}
