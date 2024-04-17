<?php

namespace App\Http\Controllers\Gospochta;

use App\Http\Controllers\Controller;
use App\Models\Gospochta\File;

class FileController extends Controller
{
    public function download($id) {
        $file = File::find($id);
        $filename = $file->original_name;
        $path = "uploads/files/" . $file->sender_id . '/' . $file->message_id . '/' . $filename;

        return response()->download($path, $filename);

//        if (file_exists($path)) {
//            if (ob_get_level()) {
//                ob_end_clean();
//            }
//            header('Content-Description: File Transfer');
//            header('Content-Type: application/octet-stream');
//            header('Content-Disposition: attachment; filename=' . basename($path));
//            header('Content-Transfer-Encoding: binary');
//            header('Expires: 0');
//            header('Cache-Control: must-revalidate');
//            header('Pragma: public');
//            header('Content-Length: ' . filesize($path));
//            readfile($path);
//            exit;
//        }
    }
}
