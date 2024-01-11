<?php

namespace App\Http\Controllers;

use App\Models\SalarySlip;
use App\Http\Requests\StoreSalarySlipRequest;
use App\Http\Requests\UpdateSalarySlipRequest;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use TCPDI;

class SalarySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tempFilePath = public_path('1223.pdf');

        $this->processUploadedPDF($tempFilePath);
        dd(1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalarySlipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SalarySlip $salarySlip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalarySlip $salarySlip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalarySlipRequest $request, SalarySlip $salarySlip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalarySlip $salarySlip)
    {
        //
    }


    private function processUploadedPDF($uploadedFilePath)
    {
        $outputPath = 'SalariesSlaps/';

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
        $pattern = "/^(0[1-9]|1[0-2])\/\d{2}$/";
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
