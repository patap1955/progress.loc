<?php

namespace App\Http\Controllers\Gospochta;

use App\Http\Controllers\Controller;
use App\Models\Gospochta\ReportDoc;
use Illuminate\Http\Request;

class ReportDocsController extends Controller
{
    public function getDocs() {
        return ReportDoc::all();
    }
}
