<?php

namespace App\Http\Controllers\Fssp;

use App\Http\Controllers\Controller;
use App\Models\Fssp\Reestr;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchLive(Request $request) {
        $data = Reestr::where($request->key, 'LIKE','%' . $request->value . '%')->limit(5)->get();
        return $data;
    }
}
