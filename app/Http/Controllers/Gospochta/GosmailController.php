<?php

namespace App\Http\Controllers\Gospochta;

use App\Http\Controllers\Controller;
use App\Models\Gospochta\GosmailReport;
use Illuminate\Http\Request;

class GosmailController extends Controller
{
    public function getReports()
    {
        return GosmailReport::where('active', '=', 1)->get();
    }
}
