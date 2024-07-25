<?php

namespace App\Http\Controllers;


use App\DataTables\ReportsDataTable;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\Report;
use App\Models\Student;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentReportController extends Controller
{


    public function show(StudentReport $student_report)
    {
        $data = [
            "student" => $student_report->student_id,
            "report" => $student_report,
            "content" => $student_report->content,
        ];

        return view('reports.show', $data);
    }

    public function generate(Request $request)
    {
        $report = Report::findOrFail(request('report'));
        $student = Student::findOrFail(request('student'));
        $date = request('date',[]);

        $reportContent = $report->content;

        foreach ($date as $key => $value) {
            $placeholder = "[dynamic name='$key']";
            $reportContent = str_replace($placeholder, $value, $reportContent);
        }


        $placeholders = [
            'name' => $student->name,
            'identification' => $student->identification,
            'birthDate' => $student->birth_date,
            'date' => date('Y-m-d'),
        ];

        $reportContent = $this->replacePlaceholders($reportContent, $placeholders);


        $studentReport = StudentReport::create([
            'student_id' => $student->id,
            'name' => $report->name,
            'subject' => $report->subject,
            'added_by' => auth()->id(),
            'content' => $reportContent,
        ]);

        if ($studentReport) {
            return response()->json(['status' => 'success', 'message' => 'تمت العملية بنجاح', 'data' => $studentReport]);
        }

        return response()->json(['status' => 'error', 'message' => 'حدث خطأ']);
    }

    private function replacePlaceholders($content, array $placeholders)
    {
        foreach ($placeholders as $placeholder => $value) {
            $content = str_replace("[$placeholder]", $value, $content);
        }

        return $content;
    }


}
