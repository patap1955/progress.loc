<?php

namespace App\Http\Controllers\Gospochta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class GetMailController extends Controller
{
    public function getMail() {
        $answer = true;
        $mail = ['type' => 1, 'message' => 'Новых писем нет'];
        if ($answer) {
            $mail['type'] = 2;
            $mail['url'] = 'https://www.gosuslugi.ru/';
            $mail['message'] = '';
            return $mail;
        }

        return $mail;
    }
}
