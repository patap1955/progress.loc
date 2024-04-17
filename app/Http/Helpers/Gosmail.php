<?php


namespace App\Http\Helpers;

use App\Models\LogSearch;
use App\Models\Setting;
use App\Models\Gospochta\File;
use App\Models\Gospochta\Log;
use App\Models\Gospochta\Message;
use App\Models\Gospochta\Sender;

use Illuminate\Support\Collection;

class Gosmail
{    
    protected $api_url = 'https://api.tdc-progress.ru/gosmail/api/request.php';
    protected $ip;
    protected $product_key;
    protected $token;
    protected $token_date = "";
    protected $settimeout = 15;


    public function __construct ()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ip = $_SERVER['HTTP_CLIENT_IP'];
        }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
        $this->product_key = env('APP_PRODUCT_KEY');
        $settings = Setting::all()->first();
        if (!is_null($settings->token)) {
            $this->token = json_decode($settings->token)->token;
            $this->token_date = json_decode($settings->token)->date;
            $this->settimeout = $settings->delay;

        }
    }

    public function process($meta) {
        $result = $this->request_m($meta);
        if ($result->error === true || $result->error === 'true'){
            $result = $this->request_t();
            if ($result->error === false || $result->error === 'false') {
                $this->token = $result->token;
                $token = Setting::all()->first();
                $collection = new Collection(["token" => $this->token, "date" => date("d.m.Y")]);
                $token->update(["token" => $collection->toJson()]);
            }
            if ($result->error === true || $result->error === 'true'){
                abort(403);
                die;    
            }else{
                $result = $this->request_m($meta);
            }
        }
        if ($result->error === false || $result->error === 'false'){
            $cookie = $result->message;
        }else{
            abort(403);
            die;
        }
        if (strlen($cookie)<100){
            abort(403);
            die;
        }else{
            $set = Setting::all()->first();
            $set->update(["value" => (new Collection($cookie))->toJson()]);
        }
        if (is_null(Sender::where('id', '=', 1)->first())){
            $sen = new Sender();
            $sen->id=1;
            $sen->title = 'Не определен';
            $sen->created_at = time();
            $sen->save();
        }
        set_time_limit(8000000);
        $message = Message::orderBy('id', 'desc')->first();       
        $feed_id = '';
        $feed_date = '';
        $feedType = array('ORDER'=>'Заявление','EQUEUE'=>'EQUEUE','PAYMENT'=>'PAYMENT','GEPS'=>'Госпочта','BIOMETRICS'=>'BIOMETRICS','ACCOUNT'=>'Документы','ACCOUNT_CHILD'=>'ACCOUNT_CHILD','PROFILE'=>'PROFILE','APPEAL'=>'APPEAL','CLAIM'=>'CLAIM','ELECTION_INFO'=>'ELECTION_INFO','COMPLEX_ORDER'=>'Заявление','FEEDBACK'=>'FEEDBACK','ORGANIZATION'=>'ORGANIZATION','BUSINESSMAN'=>'BUSINESSMAN','ESIGNATURE'=>'Системные','KND_APPEAL'=>'KND_APPEAL','LINKED_ACCOUNT'=>'LINKED_ACCOUNT','SIGN'=>'SIGN','INFO'=>'Новости','PERMISSION'=>'PERMISSION');
        $types = 'ORDER,EQUEUE,PAYMENT,GEPS,BIOMETRICS,ACCOUNT,ACCOUNT_CHILD,PROFILE,APPEAL,CLAIM,ELECTION_INFO,COMPLEX_ORDER,FEEDBACK,ORGANIZATION,BUSINESSMAN,ESIGNATURE,KND_APPEAL,LINKED_ACCOUNT,SIGN,INFO,PERMISSION'; 
        $feed = $this->get_feed($cookie, $types, $feed_id, $feed_date);  
        if ($feed){
            $feed = json_decode($feed);
            while (count($feed->items)>0){
                $find = 0;
                foreach ($feed->items as $value) {          
                    $message = Message::where('feed_id', '=', $value->id)->first();
                    if (is_null($message)){
                        $message = new Message();
                        $message->url = '';
                        $message->user_id = 1;
                        $message->sender_id = 1;
                        $message->item = json_encode($value);
                        $message->feed_id = $value->id;
                        $message->feed_date = $value->date;
                        $message->created_at = time();
                        $message->save();
                    }else{
                        $find = 1; 
                    }
                }
                /*
                if ($find == 1){
                    break;
                }
                */
                $message = Message::orderBy('id', 'desc')->first();
                if($message){
                    $feed_id = $message->feed_id;
                    $feed_date = $message->feed_date;
                }
                $feed = $this->get_feed($cookie, $types, $feed_id, $feed_date);
                $feed = json_decode($feed);
                if (!isset($feed->items) || is_null($feed->items)){
                    break;
                }
            }
        }
        $messages = Message::where('sender_id', '=', 1)->get();
        foreach ($messages as $message) {
            $item = json_decode($message->item);
            if (isset($item->feedType))
            {
                if ($item->feedType == 'ESIGNATURE' || $item->feedType == 'PAYMENT'){
                    $message->status = -1;
                }elseif($item->feedType == 'ACCOUNT'){
                    if (isset($item->data) && isset($item->data->linked_to)){
                        $message->url = 'https://lk.gosuslugi.ru'.$item->data->linked_to;
                        $message->status = -1;
                    }else{
                        $message->status = -1;
                    }          
                }elseif($item->feedType == 'CLAIM'){
                    $message->url = 'https://www.gosuslugi.ru/api/lk/v1/feeds/'.$item->id.'?_=0.'.rand(1111111111111111,9999999999999999);
                    $message->body = $this->get_message($cookie, $message->url);
                    $body = json_decode($message->body);
                    $sender_name='';
                    if (isset($body->detail->order->currentStatusHistory->sender)){
                        $sender_name = $body->detail->order->currentStatusHistory->sender;
                    }else{
                        $sender_name = $body->title;
                    }
                    $senders = Sender::where('title', '=', $sender_name)->first();
                    if (is_null($senders)){
                        $sender = new Sender();
                        $sender->title = $sender_name;
                        $sender->created_at = time();
                        $sender->save();
                        $sender_id = $sender->id;
                    }else{
                        $sender_id = $senders->id;
                    } 
                    $message->sender_id = $sender_id;
                    if (isset($body->subTitle)){
                        $message->title = $body->subTitle;
                    }  
                    if (isset($body->detail->order->currentStatusHistory)){
                        $message->subject = $body->detail->order->currentStatusHistory->comment;
                    }
                    if (isset($body->detail->order->orderResponseFiles)){                    
                        for ($j=0; $j < count($body->detail->order->orderResponseFiles); $j++) { 
                            $link = $body->detail->order->orderResponseFiles[$j]->link;
                            $link = explode("/", $link);                        
                            $file_url = 'https://www.gosuslugi.ru/api/storage/v1/files/'.urlencode($link[count($link)-3]).'/'.urlencode($link[count($link)-1]).'/download?mnemonic='.str_replace('+', '%20', urlencode($link[count($link)-2])).'&zipWithSign='.$body->detail->order->orderResponseFiles[$j]->hasDigitalSignature.'&_=0.'.rand(1111111111111111,9999999999999999);
                            $original_name = '';
                            if ($body->detail->order->orderResponseFiles[$j]->hasDigitalSignature === false){
                                $original_name = $body->detail->order->orderResponseFiles[$j]->fileName;
                            }else{
                                $original_name = $body->detail->order->orderResponseFiles[$j]->fileName;
                                $original_name = str_replace(pathinfo($original_name, PATHINFO_EXTENSION), 'zip', $original_name);
                            }
                            $file_name = $this->gen_uuid().'.'.pathinfo($original_name, PATHINFO_EXTENSION);
                            $files = File::where('original_name', '=', $original_name)->first();
                            if (is_null($files)){
                                if ($this->get_file($cookie, $file_url, $message->sender_id, $message->id, $file_name)){
                                    if (filesize($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name)>0){
                                        $file = new File();
                                        $file->message_id = $message->id;
                                        $file->sender_id = $message->sender_id;
                                        $file->url = $file_url;
                                        $file->original_name = $original_name;
                                        $file->file_name = $file_name;
                                        $file->created_at = time();
                                        $file->save();
                                    }else{
                                        $log = Log::latest()->first();
                                        $last_hash = '';
                                        if (!is_null($log)){
                                            $last_hash = $log->hash;
                                        }
                                        $msg = 'Ну удалось скачать файл для сообщения id='.$message->id.' имя файла '.$original_name;
                                        $log = new Log();
                                        $log->hash = md5($msg.$last_hash);
                                        $log->message = $msg;
                                        $log->save();  
                                        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name);
                                    }
                                }
                            }
                        }
                    }elseif (isset($body->detail->order->orderAttachmentFiles)){
                        for ($j=0; $j < count($body->detail->order->orderAttachmentFiles); $j++) { 
                            $link = $body->detail->order->orderAttachmentFiles[$j]->link;
                            $link = explode("/", $link);
                            $file_url = 'https://www.gosuslugi.ru/api/storage/v1/files/'.urlencode($link[count($link)-3]).'/'.urlencode($link[count($link)-1]).'/download?mnemonic='.str_replace('+', '%20', urlencode($link[count($link)-2])).'&zipWithSign='.$body->detail->order->orderAttachmentFiles[$j]->hasDigitalSignature.'&_=0.'.rand(1111111111111111,9999999999999999);
                            $original_name = '';
                            if ($body->detail->order->orderAttachmentFiles[$j]->hasDigitalSignature === false){
                                $original_name = $body->detail->order->orderAttachmentFiles[$j]->fileName;
                            }else{
                                $original_name = $body->detail->order->orderAttachmentFiles[$j]->fileName;
                                $original_name = str_replace(pathinfo($original_name, PATHINFO_EXTENSION), 'zip', $original_name);
                            }
                            $file_name = $this->gen_uuid().'.'.pathinfo($original_name, PATHINFO_EXTENSION);
                            $files = File::where('original_name', '=', $original_name)->first();
                            if (is_null($files)){
                                if ($this->get_file($cookie, $file_url, $message->sender_id, $message->id, $file_name)){
                                    if (filesize($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name)>0){
                                        $file = new File();
                                        $file->message_id = $message->id;
                                        $file->sender_id = $message->sender_id;
                                        $file->url = $file_url;
                                        $file->original_name = $original_name;
                                        $file->file_name = $file_name;
                                        $file->created_at = time();
                                        $file->save();
                                    }else{
                                        $log = Log::latest()->first();
                                        $last_hash = '';
                                        if (!is_null($log)){
                                            $last_hash = $log->hash;
                                        }
                                        $msg = 'Ну удалось скачать файл для сообщения id='.$message->id.' имя файла '.$original_name;
                                        $log = new Log();
                                        $log->hash = md5($msg.$last_hash);
                                        $log->message = $msg;
                                        $log->save();    
                                        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name);                                
                                    }
                                }
                            }
                        }
                    }            
                }elseif($item->feedType == 'ORDER'){
                    $message->url = 'https://www.gosuslugi.ru/api/lk/v1/feeds/'.$item->id.'?_=0.'.rand(1111111111111111,9999999999999999);
                    $message->body = $this->get_message($cookie, $message->url);
                    $body = json_decode($message->body);
                    $sender_name='';
                    if (isset($body->detail->order->currentStatusHistory->sender)){
                        $sender_name = $body->detail->order->currentStatusHistory->sender;
                    }else{
                        $sender_name = $body->title;
                    }
                    $senders = Sender::where('title', '=', $sender_name)->first();
                    if (is_null($senders)){
                        $sender = new Sender();
                        $sender->title = $sender_name;
                        $sender->created_at = time();
                        $sender->save();
                        $sender_id = $sender->id;
                    }else{
                        $sender_id = $senders->id;
                    } 
                    $message->sender_id = $sender_id;
                    if (isset($body->subTitle)){
                        $message->title = $body->subTitle;
                    }  
                    if (isset($body->detail->order->currentStatusHistory)){
                        $message->subject = $body->detail->order->currentStatusHistory->comment;
                    }
                    if (isset($body->detail->order->orderResponseFiles)){
                        for ($j=0; $j < count($body->detail->order->orderResponseFiles); $j++) { 
                            $link = $body->detail->order->orderResponseFiles[$j]->link;
                            $link = explode("/", $link);
                            $file_url = 'https://www.gosuslugi.ru/api/storage/v1/files/'.urlencode($link[count($link)-3]).'/'.urlencode($link[count($link)-1]).'/download?mnemonic='.str_replace('+', '%20', urlencode($link[count($link)-2])).'&zipWithSign='.$body->detail->order->orderResponseFiles[$j]->hasDigitalSignature.'&_=0.'.rand(1111111111111111,9999999999999999);
                            $original_name = '';
                            if ($body->detail->order->orderResponseFiles[$j]->hasDigitalSignature === false){
                                $original_name = $body->detail->order->orderResponseFiles[$j]->fileName;
                            }else{
                                $original_name = $body->detail->order->orderResponseFiles[$j]->fileName;
                                $original_name = str_replace(pathinfo($original_name, PATHINFO_EXTENSION), 'zip', $original_name);
                            }
                            $file_name = $this->gen_uuid().'.'.pathinfo($original_name, PATHINFO_EXTENSION);
                            $files = File::where('original_name', '=', $original_name)->where('message_id', '=', $message->id)->first();
                            if (is_null($files)){
                                if ($this->get_file($cookie, $file_url, $message->sender_id, $message->id, $file_name)){
                                    if (filesize($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name)>0){
                                        $file = new File();
                                        $file->message_id = $message->id;
                                        $file->sender_id = $message->sender_id;
                                        $file->url = $file_url;
                                        $file->original_name = $original_name;
                                        $file->file_name = $file_name;
                                        $file->created_at = time();
                                        $file->save();
                                    }else{
                                        $log = Log::latest()->first();
                                        $last_hash = '';
                                        if (!is_null($log)){
                                            $last_hash = $log->hash;
                                        }
                                        $msg = 'Ну удалось скачать файл для сообщения id='.$message->id.' имя файла '.$original_name;
                                        $log = new Log();
                                        $log->hash = md5($msg.$last_hash);
                                        $log->message = $msg;
                                        $log->save();
                                        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name);
                                    }
                                }
                            }
                        }
                    }elseif (isset($body->detail->order->orderAttachmentFiles)){
                        for ($j=0; $j < count($body->detail->order->orderAttachmentFiles); $j++) { 
                            $link = $body->detail->order->orderAttachmentFiles[$j]->link;
                            $link = explode("/", $link);
                            $file_url = 'https://www.gosuslugi.ru/api/storage/v1/files/'.urlencode($link[count($link)-3]).'/'.urlencode($link[count($link)-1]).'/download?mnemonic='.str_replace('+', '%20', urlencode($link[count($link)-2])).'&zipWithSign='.$body->detail->order->orderAttachmentFiles[$j]->hasDigitalSignature.'&_=0.'.rand(1111111111111111,9999999999999999);
                            $original_name = '';
                            if ($body->detail->order->orderAttachmentFiles[$j]->hasDigitalSignature === false){
                                $original_name = $body->detail->order->orderAttachmentFiles[$j]->fileName;
                            }else{
                                $original_name = $body->detail->order->orderAttachmentFiles[$j]->fileName;
                                $original_name = str_replace(pathinfo($original_name, PATHINFO_EXTENSION), 'zip', $original_name);
                            }
                            $file_name = $this->gen_uuid().'.'.pathinfo($original_name, PATHINFO_EXTENSION);
                            $files = File::where('original_name', '=', $original_name)->first();
                            if (is_null($files)){
                                if ($this->get_file($cookie, $file_url, $message->sender_id, $message->id, $file_name)){
                                    if (filesize($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name)>0){
                                        $file = new File();
                                        $file->message_id = $message->id;
                                        $file->sender_id = $message->sender_id;
                                        $file->url = $file_url;
                                        $file->original_name = $original_name;
                                        $file->file_name = $file_name;
                                        $file->created_at = time();
                                        $file->save();
                                    }else{
                                        $log = Log::latest()->first();
                                        $last_hash = '';
                                        if (!is_null($log)){
                                            $last_hash = $log->hash;
                                        }
                                        $msg = 'Ну удалось скачать файл для сообщения id='.$message->id.' имя файла '.$original_name;
                                        $log = new Log();
                                        $log->hash = md5($msg.$last_hash);
                                        $log->message = $msg;
                                        $log->save();     
                                        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name);                               
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $message->url = 'https://www.gosuslugi.ru/api/lk/v1/feeds/'.$item->id.'?_=0.'.rand(1111111111111111,9999999999999999);
                    $message->body = $this->get_message($cookie, $message->url);
                    $body = json_decode($message->body);
                    if (isset($body->title)){
                        $senders = Sender::where('title', '=', $body->title)->first();
                        if (is_null($senders)){
                            $sender = new Sender();
                            $sender->title = $body->title;
                            $sender->created_at = time();
                            $sender->save();
                            $sender_id = $sender->id;
                        }else{
                            $sender_id = $senders->id;
                        } 
                        $message->sender_id = $sender_id;
                    }
                    if (isset($body->subTitle)){
                        $message->title = $body->subTitle;
                    }
                    if (isset($body->detail->messages)){
                        $message->subject = '';
                        for ($i=0; $i < count($body->detail->messages); $i++) { 
                            $message->subject .= $body->detail->messages[$i]->text;
                            if (isset($body->detail->messages[$i]->attachments)){
                                for ($j=0; $j < count($body->detail->messages[$i]->attachments); $j++) { 
                                    $file_url = 'https://www.gosuslugi.ru/api/lk/geps/file/download/'.$body->detail->messages[$i]->attachments[$j]->attachmentId.'?inline=false&_=0.'.rand(1111111111111111,9999999999999999);
                                    $original_name = $body->detail->messages[$i]->attachments[$j]->fileName;
                                    $file_name = $this->gen_uuid().'.'.pathinfo($original_name, PATHINFO_EXTENSION);
                                    $files = File::where('original_name', '=', $original_name)->first();
                                    if (is_null($files)){
                                        if ($this->get_file($cookie, $file_url, $message->sender_id, $message->id, $file_name)){
                                            if (filesize($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name)>0){
                                                $file = new File();
                                                $file->message_id = $message->id;
                                                $file->sender_id = $message->sender_id;
                                                $file->url = $file_url;
                                                $file->original_name = $original_name;
                                                $file->file_name = $file_name;
                                                $file->created_at = time();
                                                $file->save();
                                            }else{
                                                $log = Log::latest()->first();
                                                $last_hash = '';
                                                if (!is_null($log)){
                                                    $last_hash = $log->hash;
                                                }
                                                $msg = 'Ну удалось скачать файл для сообщения id='.$message->id.' имя файла '.$original_name;
                                                $log = new Log();
                                                $log->hash = md5($msg.$last_hash);
                                                $log->message = $msg;
                                                $log->save();   
                                                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$message->sender_id.'/'.$message->id.'/'.$file_name);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $message->save();
        }
        var_dump('expression');
        die;
        return redirect('/');
    }

    protected function request_t() {
        $params = array('func'=>'get_token', 'product_key' => $this->product_key, 'ip' => $this->ip);
        $a_url = $this->api_url . '?' . http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $a_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "User-Agent: ".$_SERVER['HTTP_USER_AGENT'];
        $headers[] = "Accept: */*";
        $headers[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Referer: ".$_SERVER['SERVER_NAME'];
        $headers[] = "Sec-Fetch-Dest: script";
        $headers[] = "Sec-Fetch-Mode: no-cors";
        $headers[] = "Sec-Fetch-Site: same-site";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }    

    protected function request_m($meta){
        $params = array('func'=>'get_cookie', 'token' => $this->token, 'ip' => $this->ip, 'meta' => $meta);
        $a_url = $this->api_url . '?' . http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $a_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "User-Agent: ".$_SERVER['HTTP_USER_AGENT'];
        $headers[] = "Accept: */*";
        $headers[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Referer: ".$_SERVER['SERVER_NAME'];
        $headers[] = "Sec-Fetch-Dest: script";
        $headers[] = "Sec-Fetch-Mode: no-cors";
        $headers[] = "Sec-Fetch-Site: same-site";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        return $result;
    }

    protected function date_difference($date)
    {
        $now = time(); // текущее время (метка времени)
        $your_date = strtotime($date); // какая-то дата в строке (1 января 2017 года)
        $datediff = $now - $your_date; // получим разность дат (в секундах)

        return floor($datediff / (60 * 60 * 24));
    }

    protected function date_difference_int($date, int $int = 30)
    {
//        dd($int - date_difference($date));
        return $int - date_difference($date);
    }

    protected function htmlspecialcharsDecode($str)
    {
        return str_replace('\\', '', $str);
    }

    protected function get_feed($cookie, $types='GEPS', $feed_id='', $feed_date=''){        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.gosuslugi.ru/api/lk/v1/feeds/?unread=false&isArchive=false&isHide=false&types='.$types.'&pageSize=15&status=&startDate=&lastFeedId='.urlencode($feed_id).'&lastFeedDate='.urlencode($feed_date).'&q=&_=0.'.rand(1111111111111111,9999999999999999));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        $headers = array();
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0';
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip, deflate, br';
        $headers[] = 'X-B3-Traceid: 0acac6b328261036';
        $headers[] = 'X-B3-Spanid: 1b8659ca7751e042';
        $headers[] = 'X-B3-Parentspanid: bdf3220a26f9f6d0';
        $headers[] = 'X-B3-Sampled: 1';
        $headers[] = 'Origin: https://lk.gosuslugi.ru';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Referer: https://lk.gosuslugi.ru/';
        $headers[] = 'Cookie: '.$cookie;
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Te: trailers';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, 'https://www.gosuslugi.ru/api/lk/v1/feeds/?unread=false&isArchive=false&isHide=false&types='.$types.'&pageSize=15&status=&startDate=&lastFeedId='.urlencode($feed_id).'&lastFeedDate='.urlencode($feed_date).'&q=&_=0.'.rand(1111111111111111,9999999999999999));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//        $headers = array();
//        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0';
//        $headers[] = 'Accept: application/json, text/plain, */*';
//        $headers[] = 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3';
//        $headers[] = 'Accept-Encoding: gzip, deflate, br';
//        $headers[] = 'X-B3-Traceid: fa1dd6ed0f61fab9';
//        $headers[] = 'X-B3-Spanid: 6b5309195a430145';
//        $headers[] = 'X-B3-Parentspanid: daf3922ea7b9dc54';
//        $headers[] = 'X-B3-Sampled: 1';
//        $headers[] = 'Origin: https://lk.gosuslugi.ru';
//        $headers[] = 'Connection: keep-alive';
//        $headers[] = 'Referer: https://lk.gosuslugi.ru/';
//        $headers[] = 'Cookie: '.$cookie;
//        $headers[] = 'Sec-Fetch-Dest: empty';
//        $headers[] = 'Sec-Fetch-Mode: cors';
//        $headers[] = 'Sec-Fetch-Site: same-site';
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        $result = curl_exec($ch);
//        dd($result);
//        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        dd($http_code);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
        
        return $result;
    }

    protected function get_message($cookie, $url=''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0';
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip, deflate, br';
        $headers[] = 'X-B3-Traceid: fa1dd6ed0f61fab9';
        $headers[] = 'X-B3-Spanid: 6b5309195a430145';
        $headers[] = 'X-B3-Parentspanid: daf3922ea7b9dc54';
        $headers[] = 'X-B3-Sampled: 1';
        $headers[] = 'Origin: https://lk.gosuslugi.ru';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Referer: https://lk.gosuslugi.ru/';
        $headers[] = 'Cookie: '.$cookie;
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Site: same-site';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING , 'gzip');
        $result = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    protected function get_file($cookie, $url='', $sender_id, $message_id, $file_name){
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/uploads/', 0755);
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/files/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/uploads/files/', 0755);
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$sender_id.'/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$sender_id.'/', 0755);
        }
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$sender_id.'/'.$message_id.'/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$sender_id.'/'.$message_id.'/', 0755);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        $headers = array();
        $headers[] = 'Authority: www.gosuslugi.ru';
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,sk;q=0.6';
        $headers[] = 'Cookie: '.urldecode($cookie);
        $headers[] = 'Origin: https://lk.gosuslugi.ru';
        $headers[] = 'Referer: https://lk.gosuslugi.ru/';
        $headers[] = 'Sec-Ch-Ua: ^^Not_A';
        $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
        $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/uploads/files/'.$sender_id.'/'.$message_id.'/'.$file_name, 'w');
        fwrite($fp, $result);
        fclose($fp);
        return true;
    }

    protected function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}
