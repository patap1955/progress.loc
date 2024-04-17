<?php

namespace App\Http\Controllers\Gospochta;

use App\Http\Controllers\Controller;
use App\Models\Gospochta\Sender;
use Illuminate\Http\Request;

class SendersController extends Controller
{
    public function index() {
        return Sender::all();
    }

    public function show($id) {
        $sender = Sender::with('messages')->where('id', '=', $id)->first();
        return $sender;
    }
}
