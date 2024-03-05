<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\StudentReport;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
class StudentReportController extends Controller
{


    public function create()
    {
        return view('student.report.create');
    }

    public function store(Request $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        StudentReport::create($data);

        Session::flash('message', 'تم اضافة تقرير جديد بنجاح.');
        return redirect()->back();
    }


    public function show(StudentReport $studentReport)
    {
        $student = Student::findOrFail(request("student"));

        $data = [
            "student" => $student,
            "studentReport" => $studentReport,
            "content" => str_replace(["[name]", "[identification]", "[birthDate]", "[date]"], [$student->name, $student->identification, $student->birth_date,date('Y-m-d')], $studentReport->content),
        ];


        return view('student.report.show', $data);
    }


    private function findTagAndReplace($str, $replacement)
    {

        $replacement = "[" . $replacement . "]";

        $start = preg_quote("[", '/');
        $end = preg_quote("]", '/');
        $regex = "/([)(.*?)(])/";

        return preg_replace($regex, $replacement, $str);
    }
}
