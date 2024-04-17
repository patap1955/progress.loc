<?php

namespace App\Http\Controllers\Gospochta;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Gosmail;
use App\Models\Gospochta\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index($sender, $message) {
        $message = Message::with('sender')->with('files')->where('id', '=', $message)->first();
        return $message;
    }

    public function get_json($type, $meta){
        $gosmail = new Gosmail(); 
        $gosmail->process($meta);
    }
}
