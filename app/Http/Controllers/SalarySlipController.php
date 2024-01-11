<?php

namespace App\Http\Controllers;

use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Smalot\PdfParser\Parser;
use TCPDI;

class SalarySlipController extends Controller
{

    public function index()
    {

        $tempFilePath = public_path('1223.pdf');

        $this->processUploadedPDF($tempFilePath);
        dd(1);
    }

    public function upload(Request $request)
    {

        return redirect()->back();
    }


    private function processUploadedPDF($uploadedFilePath)
    {
        $outputPath = public_path('uploaded2/');
        if (!is_dir($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $parser2 = new Parser();
        $pdfParsed = $parser2->parseFile($uploadedFilePath);
        foreach ($pdfParsed->getPages() as $pageNumber => $page) {
            // $tcpdf->AddPage();
            $text = $page->getTextArray();
            $idNumbersArray = $this->extractValuesBetweenKeys($text, 5, 15);
            $idNumber = $this->getIdNumberFromArray($idNumbersArray);
            $datesArray = $this->extractValuesBetweenKeys($text, 90, 120);
            $getMonthYearStr = $this->getMonthFromArray($text);
            $outputFilename = $outputPath;
            if (!empty($getMonthYearStr)) {
                $outputFilename .= '[' . $getMonthYearStr . ']-';
            }
            if (!empty($idNumber)) {
                $outputFilename .= $idNumber;
            }
            if (empty($getMonthYearStr) && empty($idNumber)) {
                $outputFilename = $outputPath . 'unknown_' . $pageNumber;
            }
            $outputFilename .= '.pdf';
            $tcpdi = new \setasign\Fpdi\Tcpdf\Fpdi();
            $tcpdi->setSourceFile($uploadedFilePath);
            $tplId = $tcpdi->importPage($pageNumber + 1);
            $tcpdi->AddPage();

            $tcpdi->useTemplate($tplId, 0, 0);
            $tcpdi->Output($outputFilename, 'F');

        }
    }


    private function isValidDateFormat($input)
    {
        $pattern = "/^(0[1-9]|1[0-2])\/\d{2}$/";
        return preg_match($pattern, $input) === 1;
    }

    private function getMonthFromArray($array = array())
    {
        $IdnumberFound = '';
        foreach ($array as $key => $value) {
            if ($this->isValidDateFormat($value)) $IdnumberFound = str_replace('/', '-', $value);
        }
        return $IdnumberFound;
    }

    private function getIdNumberFromArray($array = array())
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
            return array();
        }
    }


}
