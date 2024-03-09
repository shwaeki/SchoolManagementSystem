<?php

namespace App\Http\Controllers;

use App\DataTables\ReportsDataTable;
use App\Models\Report;

use App\Models\Student;
use App\Models\StudentReport;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{

    public function index(ReportsDataTable $dataTable)
    {
        return $dataTable->render('reports.index');
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        Report::create($data);

        Session::flash('message', 'تم اضافة تقرير جديد بنجاح.');
        return redirect()->route('reports.index');
    }


    public function show(Report $report)
    {
        if ($report->type === "student") {
            $reportDate = Student::findOrFail(request("student"));
        } else {
            $reportDate = Teacher::findOrFail(request("teacher"));
        }

        $placeholders = [
            'name' => $reportDate->name,
            'identification' => $reportDate->identification,
            'birthDate' => $reportDate->birth_date,
            'date' => date('Y-m-d'),
        ];

        $reportContent = $this->replacePlaceholders($report->content, $placeholders);


        $data = [
            "report" => $report,
            "content" => $reportContent,
        ];


        return view('reports.show', $data);
    }


    public function edit(Report $report)
    {
        $date = [
            'report' => $report,
        ];

        return view('reports.edit', $date);
    }


    public function update(Request $request, Report $report)
    {
        $report->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات التقرير بنجاح.');
        return redirect()->route('reports.index');
    }

    private function replacePlaceholders($content, array $placeholders)
    {
        foreach ($placeholders as $placeholder => $value) {
            $content = str_replace("[$placeholder]", $value, $content);
        }

        return $content;
    }
}
