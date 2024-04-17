<?php

namespace App\Http\Controllers\Fssp;

use App\Http\Controllers\Controller;
use App\Models\Fssp\Doc;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function getDocs() {
        return Doc::all();
    }
}
