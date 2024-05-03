<?php

namespace App\Http\Controllers\Gospochta;

use App\Exports\ExportReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Helpers\Gosmail;

class DownloadReportController extends Controller
{
    public function downloadReportTime(Request $request) {
        $request->dataStart = date("Y-m-d",strtotime("+1 day", strtotime($request->dataStart)));
        $request->dataEnd = date("Y-m-d",strtotime("+2 day", strtotime($request->dataEnd)));
        return (new Gosmail())->get_reports_files($request->dataStart, $request->dataEnd);
    }

    public function downloadReportDoc() {
        $request->dataStart = date("Y-m-d",strtotime("+1 day", strtotime($request->dataStart)));
        $request->dataEnd = date("Y-m-d",strtotime("+2 day", strtotime($request->dataEnd)));
        return (new Gosmail())->get_reports_files($request->dataStart, $request->dataEnd, $request->selectedDoc);
    }
}
