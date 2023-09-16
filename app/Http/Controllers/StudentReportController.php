<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
class StudentReportController extends Controller
{
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
            "content" => str_replace(["[name]", "[identification]", "[birthDate]"], [$student->name, $student->identification, $student->birth_date], $studentReport->content),
        ];


        //   if($request->has('download')){

       // $html = view('student.report', $data)->toArabicHTML();

        $pdf = PDF::loadView('student.report', $data);
        $wimg = public_path('assets/img/report.jpg');
        $pdf->getMpdf()->SetWatermarkImage($wimg, 0.4, 'D', 'F');

        return $pdf->stream('report2.pdf');

        //    }

        return view('student.report', $data);
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
