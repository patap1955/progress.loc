<?php

namespace App\Http\Controllers\Gospochta;

use App\Exports\ExportReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadReportController extends Controller
{
    public function downloadReportTime(Request $request) {
        //$request->dataStart - начальная дата поиска
        //$request->dataEnd - конечная дата поиска
        return Excel::download(new ExportReport(), 'report.xlsx');
    }

    public function downloadReportDoc() {
        //$request->dataStart - начальная дата поиска
        //$request->dataEnd - конечная дата поиска
        //$request->selectedDoc - тип документа
        return Excel::download(new ExportReport(), 'report.xlsx');
    }
}
