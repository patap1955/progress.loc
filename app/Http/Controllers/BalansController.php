<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Fssp;
use Illuminate\Http\Request;

class BalansController extends Controller
{
    public function getBalans(Fssp $fssp)
    {
        $answer = $fssp->request_a();
        return $answer;
    }
}
