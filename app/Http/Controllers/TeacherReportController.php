<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Teacher;
use App\Models\TeacherReport;
use Illuminate\Http\Request;

class TeacherReportController extends Controller
{


    public function show(TeacherReport $teacherReport)
    {
        $data = [
            "report" => $teacherReport,
            "content" => $teacherReport->content,
        ];

        return view('reports.show', $data);
    }

    public function generate(Request $request)
    {
        $report = Report::findOrFail(request('report'));
        $teacher = Teacher::findOrFail(request('teacher'));
        $date = request('date');

        $reportContent = $report->content;

        foreach ($date as $key => $value) {
            $placeholder = "[dynamic name='$key']";
            $reportContent = str_replace($placeholder, $value, $reportContent);
        }


        $placeholders = [
            'name' => $teacher->name,
            'identification' => $teacher->identification,
            'birthDate' => $teacher->birth_date,
            'date' => date('Y-m-d'),
        ];

        $reportContent = $this->replacePlaceholders($reportContent, $placeholders);


        $teacherReport = TeacherReport::create([
            'teacher_id' => $teacher->id,
            'name' => $report->name,
            'subject' => $report->subject,
            'added_by' => auth()->id(),
            'content' => $reportContent,
        ]);

        if ($teacherReport) {
            return response()->json(['status' => 'success', 'message' => 'تمت العملية بنجاح', 'data' => $teacherReport]);
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
