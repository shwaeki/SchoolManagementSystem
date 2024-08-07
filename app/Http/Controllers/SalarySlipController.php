<?php

namespace App\Http\Controllers;

use App\DataTables\AssistantDataTable;
use App\DataTables\SalariesDataTable;
use App\Models\SalarySlip;
use App\Models\SalarySlipFile;
use App\Http\Requests\StoreSalarySlipRequest;
use App\Http\Requests\UpdateSalarySlipRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use TCPDI;

class SalarySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(SalariesDataTable $dataTable)
    {
        return $dataTable->render('salaries.index');
    }


    public function create()
    {
        return view('salaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalarySlipRequest $request)
    {
        $data = request('date');
        $file = $request->file('file');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/salariesSlapsFiles', $name);

        SalarySlipFile::create([
            'file_path' => $name,
            'date' => $data,
            'added_by' => auth()->id(),
        ]);

        Session::flash('message', 'تم اضافة ملف جديد بنجاح.');
        return redirect()->route('salaries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalarySlipFile $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalarySlipFile $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalarySlipRequest $request, SalarySlipFile $salary)
    {

        if ($salary->status !== "done") {
            $tempFilePath = public_path('storage/salariesSlapsFiles/'.$salary->file_path);
            $this->processUploadedPDF($tempFilePath);
            $salary->update(['status' => 'done']);
        }
        Session::flash('message', 'تماضافة اقسائم الرواتب الى الموظفين.');
        return redirect()->route('salaries.index'); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalarySlipFile $salary)
    {
        //
    }


    private function processUploadedPDF($uploadedFilePath)
    {
        $outputPath = 'salariesSlaps';

        $parser2 = new Parser();
        $pdfParsed = $parser2->parseFile($uploadedFilePath);
        foreach ($pdfParsed->getPages() as $pageNumber => $page) {

            $text = $page->getTextArray();
            $idNumbersArray = $this->extractValuesBetweenKeys($text, 5, 15);
            $idNumber = $this->getIdNumberFromArray($idNumbersArray);


            $getMonthYearStr = $this->getMonthFromArray($text);
            $outputFilename = $outputPath;

            if (!empty($idNumber)) {
                $outputFilename = $idNumber;
            }
            if (empty($idNumber)) {
                $outputFilename = 'unknown_' . $pageNumber;
            }
            $outputFilename .= '.pdf';
            $tcpdi = new \setasign\Fpdi\Tcpdf\Fpdi();
            $tcpdi->setSourceFile($uploadedFilePath);
            $tplId = $tcpdi->importPage($pageNumber + 1);
            $tcpdi->AddPage();

            $tcpdi->useTemplate($tplId, 0, 0);

            $storageDisk = Storage::disk('public');

            $year = "";
            if (!empty($getMonthYearStr)) {
                $year = '/' . $getMonthYearStr . '/';
            }


            $file_path = $outputPath . $year . $outputFilename;

            $pdfData = $tcpdi->Output($file_path, 'S');
            $storageDisk->put($file_path, $pdfData);

            SalarySlip::create([
                'date' => $getMonthYearStr ?? '',
                'identification' => $idNumber ?? '',
                'file_path' => $file_path,
            ]);

        }
    }


    private function isValidDateFormat($input)
    {
        $pattern = "/^(0?[1-9]|1[0-2])\/\d{2}$/";
        return preg_match($pattern, $input) === 1;
    }

    private function getMonthFromArray($array = [])
    {
        $IdnumberFound = '';
        foreach ($array as $key => $value) {
            if ($this->isValidDateFormat($value)) $IdnumberFound = str_replace('/', '-', $value);
        }
        return $IdnumberFound;
    }

    private function getIdNumberFromArray($array = [])
    {
        $IdnumberFound = '';
        foreach ($array as $key => $value) {
            if ($this->containsNumberWithDash($value)) $IdnumberFound = str_replace('-', '', $value);
        }
        return $IdnumberFound;
    }

    private function containsNumberWithDash($string)
    {
        $pattern = '/\d+-\d+$/';
        return preg_match($pattern, $string) === 1;
    }

    private function extractValuesBetweenKeys($array, $startKey, $endKey)
    {
        $keys = array_keys($array);
        $startIndex = array_search($startKey, $keys);
        $endIndex = array_search($endKey, $keys);
        if ($startIndex !== false && $endIndex !== false) {
            $values = array_slice($array, $startIndex, $endIndex - $startIndex + 1, true);
            return $values;
        } else {
            return [];
        }
    }

}
