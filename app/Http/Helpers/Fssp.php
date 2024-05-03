<?php

namespace App\Http\Helpers;

use App\Models\LogSearch;
use App\Models\Setting;
use Illuminate\Support\Collection;

class Fssp
{
    public $regions = array(array('id'=>"02", 'value' =>'Республика Башкортостан'), array('id'=>"03", 'value' =>'Республика Бурятия'), array('id'=>"04", 'value' =>'Республика Алтай'), array('id'=>"05", 'value' =>'Республика Дагестан'), array('id'=>"06", 'value' =>'Республика Ингушетия'), array('id'=>"07", 'value' =>'Кабардино-Балкария'), array('id'=>"08", 'value' =>'Республика Калмыкия'), array('id'=>"09", 'value' =>'Карачаево-Черкесия'), array('id'=>"10", 'value' =>'Республика Карелия'), array('id'=>"11", 'value' =>'Республика Коми'), array('id'=>"12", 'value' =>'Республика Марий Эл'), array('id'=>"13", 'value' =>'Республика Мордовия'), array('id'=>"14", 'value' =>'Республика Саха (Якутия)'), array('id'=>"15", 'value' =>'Северная Осетия-Алания'), array('id'=>"16", 'value' =>'Республика Татарстан'), array('id'=>"17", 'value' =>'Республика Тыва'), array('id'=>"18", 'value' =>'Удмуртская Республика'), array('id'=>"19", 'value' =>'Республика Хакасия'), array('id'=>"20", 'value' =>'Чеченская Республика'), array('id'=>"21", 'value' =>'Чувашская Республика - Чувашия'), array('id'=>"22", 'value' =>'Алтайский край'), array('id'=>"23", 'value' =>'Краснодарский край'), array('id'=>"24", 'value' =>'Красноярский край'), array('id'=>"25", 'value' =>'Приморский край'), array('id'=>"26", 'value' =>'Ставропольский край'), array('id'=>"27", 'value' =>'Хабаровский край и Еврейская автономная область'), array('id'=>"28", 'value' =>'Амурская область'), array('id'=>"29", 'value' =>'Архангельская область и Ненецкий автономный округ'), array('id'=>"30", 'value' =>'Астраханская область'), array('id'=>"31", 'value' =>'Белгородская область'), array('id'=>"32", 'value' =>'Брянская область'), array('id'=>"33", 'value' =>'Владимирская область'), array('id'=>"34", 'value' =>'Волгоградская область'), array('id'=>"35", 'value' =>'Вологодская область'), array('id'=>"36", 'value' =>'Воронежская область'), array('id'=>"37", 'value' =>'Ивановская область'), array('id'=>"38", 'value' =>'Иркутская область'), array('id'=>"39", 'value' =>'Калининградская область'), array('id'=>"40", 'value' =>'Калужская область'), array('id'=>"41", 'value' =>'Камчатский край и Чукотский автономный округ'), array('id'=>"42", 'value' =>'Кемеровская область - Кузбасс'), array('id'=>"43", 'value' =>'Кировская область'), array('id'=>"44", 'value' =>'Костромская область'), array('id'=>"45", 'value' =>'Курганская область'), array('id'=>"46", 'value' =>'Курская область'), array('id'=>"47", 'value' =>'Ленинградская область'), array('id'=>"48", 'value' =>'Липецкая область'), array('id'=>"49", 'value' =>'Магаданская область'), array('id'=>"50", 'value' =>'Московская область'), array('id'=>"51", 'value' =>'Мурманская область'), array('id'=>"52", 'value' =>'Нижегородская область'), array('id'=>"53", 'value' =>'Новгородская область'), array('id'=>"54", 'value' =>'Новосибирская область'), array('id'=>"55", 'value' =>'Омская область'), array('id'=>"56", 'value' =>'Оренбургская область'), array('id'=>"57", 'value' =>'Орловская область'), array('id'=>"58", 'value' =>'Пензенская область'), array('id'=>"59", 'value' =>'Пермский край'), array('id'=>"60", 'value' =>'Псковская область'), array('id'=>"61", 'value' =>'Ростовская область'), array('id'=>"62", 'value' =>'Рязанская область'), array('id'=>"63", 'value' =>'Самарская область'), array('id'=>"64", 'value' =>'Саратовская область'), array('id'=>"65", 'value' =>'Сахалинская область'), array('id'=>"66", 'value' =>'Свердловская область'), array('id'=>"67", 'value' =>'Смоленская область'), array('id'=>"68", 'value' =>'Тамбовская область'), array('id'=>"69", 'value' =>'Тверская область'), array('id'=>"70", 'value' =>'Томская область'), array('id'=>"71", 'value' =>'Тульская область'), array('id'=>"72", 'value' =>'Тюменская область'), array('id'=>"73", 'value' =>'Ульяновская область'), array('id'=>"74", 'value' =>'Челябинская область'), array('id'=>"75", 'value' =>'Забайкальский край'), array('id'=>"76", 'value' =>'Ярославская область'), array('id'=>"77", 'value' =>'Москва'), array('id'=>"78", 'value' =>'Санкт-Петербург'), array('id'=>"80", 'value' =>'Донецкая Народная Республика'), array('id'=>"81", 'value' =>'Луганская Народная Республика'), array('id'=>"82", 'value' =>'Республика Крым и Севастополь'), array('id'=>"84", 'value' =>'Херсонская область'), array('id'=>"85", 'value' =>'Запорожская область'), array('id'=>"86", 'value' =>'Ханты-Мансийский АО'), array('id'=>"89", 'value' =>'Ямало-Ненецкий АО'));
    public $docs = array(array("id"=>3, "title"=>"Акт по делу об административном правонарушении"), array("id"=>4, "title"=>"Судебный приказ"), array("id"=>5, "title"=>"Акт органа, осуществляющего контрольные функции"), array("id"=>6, "title"=>"Удостоверение комиссии по трудовым спорам"), array("id"=>7, "title"=>"Акт другого органа"), array("id"=>8, "title"=>"Постановление судебного пристава-исполнителя"), array("id"=>18, "title"=>"Нотариально удостоверенное медиативное соглашение"), array("id"=>10, "title"=>"Исполнительная надпись нотариуса"), array("id"=>11, "title"=>"Судебный акт по делу об административном правонарушении"), array("id"=>12, "title"=>"Запрос центрального органа о розыске ребенка"), array("id"=>13, "title"=>"Исполнительный документ, выданный компетентным органом иностранного государства"), array("id"=>19, "title"=>"Решение государственного инспектора труда о принудительном исполнении обязанности работодателя по выплатам, осуществляемым в рамках трудовых отношений"), array("id"=>16, "title"=>"Удостоверение, выданное уполномоченным по правам потребителей финансовых услуг в порядке, предусмотренном Федеральным законом от 04.06.2018 № 123-ФЗ \"Об уполномоченном по правам потребителей финансовых услуг\""), array("id"=>1, "title"=>"Исполнительный лист"), array("id"=>2, "title"=>"Нотариально удостоверенное соглашение об уплате алиментов"), array("id"=>17, "title"=>"Опре-ие судьи о наложении ареста на им-во в целях обеспечения исполнения постановления о назначении адм-го наказания за совершение адм-го правонарушения, предусмотренного статьей 19.28 Кодекса Российской Федерации об адм-ных правонарушениях"));
    public $search_type;

    public $errors_messages = array(
        0=>array('code'=>0, 'label'=>'undefined error code'),
        301=>array('code'=>301, 'label'=>'fssp response result->data is NULL'),
        302=>array('code'=>302, 'label'=>'Service Temporarily Unavailable'),
        404=>array('code'=>404, 'label'=>'fssp response not found'),
        701=>array('code'=>701, 'label'=>'invalid product_key'),
        702=>array('code'=>702, 'label'=>'invalid token'),
        703=>array('code'=>703, 'label'=>'invalid call_back_label'),
        704=>array('code'=>704, 'label'=>'fssp ddos defender'),
        705=>array('code'=>705, 'label'=>'fssp long request'),
        706=>array('code'=>706, 'label'=>'connection limit exceeded'),
        905=>array('code'=>905, 'label'=>'catch breakpoint')
    );
    protected $address = '';
    protected $api_url = 'https://api.tdc-progress.ru/fssp/api/request.php';
    protected $date = '';
    protected $drtr_name = '';
    protected $first_name = '';
    protected $inn = '';
    protected $id_number = '';
    protected $id_issuer = '';
    protected $id_type = '';
    protected $ip;
    protected $ip_number = '';
    protected $is_node = '';
    protected $last_name = '';
    protected $matches;
    protected $patronymic = '';
    protected $product_key;
    protected $region_id = '';
    protected $token;
    protected $tm;
    protected $variant = '';
    protected $token_date = "";
    protected $settimeout = 15;

    public function __construct ()
    {
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/in/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/in/', 0755);
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ip = $_SERVER['HTTP_CLIENT_IP'];
        }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
        $this->product_key = env('FSSP_PRODUCT_KEY');
        if (is_null($this->product_key)){
            $this->product_key = $this->get_config('FSSP_PRODUCT_KEY');
        }
        $settings = Setting::all()->first();
        if (!is_null($settings->token)) {
            $this->token = json_decode($settings->token)->token;
            $this->token_date = json_decode($settings->token)->date;
            $this->settimeout = $settings->delay;

        } else {

        }
        $this->tm = time();
    }

    public function test(array $data) {
//        dd($this->product_key);
        set_time_limit(8000000);
        $this->set_cf($data);
        if ($this->product_key) {
//            dd($this->product_key);
            if ($this->token_date != date("d.m.Y")) {
                $this->token = $this->request_t();
                if ($this->token->error == 'false') {
                    $this->token = $this->token->token;
                    $token = Setting::all()->first();
                    $collection = new Collection(["token" => $this->token, "date" => date("d.m.Y")]);
                    $token->update(["token" => $collection->toJson()]);
                }
            }

            if ($this->token) {
                $call_back_label = $this->request_c();

                if ($call_back_label->error == 'false') {
                    $this->is_node = $call_back_label->node;
                    $call_back_label = $call_back_label->label;
                    $call_back_label .= '_' . $this->tm;
                    $host = 'https://' . $this->is_node;

                    $url = $host
                        . '/ajax_search?callback='
                        . $call_back_label
                        . '&system=ip&is[extended]=1&nocache=1&is[variant]='
                        . $this->variant.'&is[region_id][0]='
                        . $this->region_id.'&is[last_name]='
                        . $this->last_name.'&is[first_name]='
                        . $this->first_name.'&is[drtr_name]='
                        . $this->drtr_name.'&is[ip_number]='
                        . $this->ip_number.'&is[patronymic]='
                        . $this->patronymic.'&is[date]='
                        . $this->date.'&is[address]='
                        . $this->address.'&is[id_number]='
                        . $this->id_number.'&is[id_type][0]='
                        . $this->id_type.'&is[id_issuer]='
                        . $this->id_issuer.'&is[inn]='
                        . $this->inn.'&_='
                        . time();
//                    dd($url);
                    $matches_ar = $this->request_1($url);
                    if ($matches_ar) {
                        $image = $matches_ar["image"];
                        $result = $this->get_search_result($host, $call_back_label);
//                        dd($result);
//                        return $result;
                        if (strpos($result, 'Вы превысили лимит на количество подключений к сайту') > 0) {
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/' . $this->tm . '.wav');
                            return $this->config_error_message(706);
                        } elseif (strpos($result, 'Извините, что-то пошло не так. Попробуйте позже') > 0) {
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/' . $this->tm . '.wav');
                            return $this->config_error_message(704);
                        } elseif (strpos($result, 'Неверно введен код') > 0) {
                            $this->request_m($this->token, $image);
                            //echo (time()-$time_start).' сек. Повторный запрос капчи <br>';
                            $result = $this->get_search_result($host, $call_back_label);
//                            dd($result);
                            unlink($_SERVER['DOCUMENT_ROOT'] . '/in/' . $this->tm . '.wav');
                            $input = array('error' => false, 'header' => array(), 'body' => array(), 'next' => '');
                            $input = $this->request_r($result, $input);
//                            return $input;
                            while($input['error'] == false && $input['next'] != ''){
                                $input = $this->request_r($result, $input);
                            }
                            return json_encode($input);
                        } elseif (strpos($result, 'Ваш запрос уже обрабатывается') > 0) {
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/' . $this->tm . '.wav');
                            return $this->config_error_message(705);
                        } else {
                            unlink($_SERVER['DOCUMENT_ROOT'] . '/in/' . $this->tm . '.wav');
                            $input = array('error' => false, 'header' => array(), 'body' => array(), 'next' => '');
                            $input = $this->request_r($result, $input);
                            //dd($result);
                            if (isset($input['error']) || isset($input['error']) && isset($input['next'])) {
                                while ($input['error'] == false && $input['next'] != '') {
                                    sleep($this->settimeout);
                                    $url = $input['next'];
                                    $this->request_1($url);
//                                    $this->request_j($url);
                                    sleep(random_int(1, 2));
                                    $url = $host . '/get_audio_captcha/?callback=' . $call_back_label . '&_=' . time();
                                    $result = $this->request_i($url);
                                    $url = $host . $result->data;
                                    $this->request_l($url);
                                    sleep(random_int(1, 2));
                                    $captcha = $this->request_d();
                                    unlink($_SERVER['DOCUMENT_ROOT'] . '/in/' . $this->tm . '.wav');
                                    $input['next'] = str_replace('&amp;', '&', $input['next']);
                                    $url = $input['next'] . '&code=' . urlencode($captcha);
                                    $result = $this->request_j($url);
                                    $input = $this->request_r($result, $input);
                                }
                            } else {
                                return $this->config_error_message(905);
                            }
                            return json_encode($input);
                        }
                    } else {
                        /*не прошел запрос*/
                        return $this->config_error_message(302);
                    }
                } else {
                    return $this->config_error_message(703);
                }

            } else {
                return $this->config_error_message(702);
            }


        } else {
            return $this->config_error_message(701);
        }
    }

    public function fssp_search_ip($data){
        $this->search_type = 1;
        $time_start = time();
        $this->set_cf(1);
        $set = new settings();
        $this->product_key = $set->get_value('product_key');
        if ($this->product_key) {
            $this->token = $set->get_value('token');
            if (is_null($this->token) || json_decode($this->token)->date == date("d.m.Y")){
                $this->token = json_decode($this->token)->token;
            } else {
                $this->token = $this->request_t();
                if ($this->token->error == 'false'){
                    $this->token = $this->token->token;
                    $set->set_value('token', json_encode(array('token'=>$this->token,'date'=>date("d.m.Y"))));
                } else {
                    $this->token = false;
                }
            }
            if ($this->token)
            {
                $call_back_label = $this->request_c();
                if ($call_back_label->error == 'false'){
                    $this->is_node = $call_back_label->node;
                    $call_back_label = $call_back_label->label;
                    $call_back_label .= '_'.$this->tm;
                    $host = 'https://'.$this->is_node;
//                    return $host;

                    $url = $host . '/ajax_search?callback=' . $call_back_label.'&system=ip&is[extended]=1&nocache=1&is[variant]='.$this->variant.'&is[region_id][0]='.$this->region_id.'&is[last_name]='.$this->last_name.'&is[first_name]='.$this->first_name.'&is[drtr_name]='.$this->drtr_name.'&is[ip_number]='.$this->ip_number.'&is[patronymic]='.$this->patronymic.'&is[date]='.$this->date.'&is[address]='.$this->address.'&is[id_number]='.$this->id_number.'&is[id_type][0]='.$this->id_type.'&is[id_issuer]='.$this->id_issuer.'&is[inn]='.$this->inn.'&_='.time();
                    $matches_ar = $this->request_1($url);
                    if ($matches_ar){
                        $image = $matches_ar["image"];
                        $result = $this->get_search_result($host, $call_back_label);
                        if (strpos($result, 'Извините, что-то пошло не так. Попробуйте позже')>0){
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
                            return $this->config_error_message(704);
                        }else if (strpos($result, 'Неверно введен код')>0){
                            //echo 'Отправляем файлы для анализа<br>';
                            $this->request_m($token, $image);
                            //echo (time()-$time_start).' сек. Повторный запрос капчи <br>';
                            $result = $this->get_search_result($host, $call_back_label);
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
                            $input = array('error'=>false, 'header'=>array(), 'body'=>array(), 'next'=>'');
                            $input = $this->request_r($result, $input);
                            while($input['error']==false && $input['next']!=''){
                                $input = $this->request_r($result, $input);
                            }
                            return json_encode($input);
                        }else if(strpos($result, 'Ваш запрос уже обрабатывается')>0){
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
                            return $this->config_error_message(705);
                        }else{
                            unlink($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
                            $input = array('error'=>false, 'header'=>array(), 'body'=>array(), 'next'=>'');
                            $input = $this->request_r($result, $input);
                            if (isset($input['error'])){
                                while($input['error']==false && $input['next']!=''){
                                    sleep($set->get_value('delay'));
                                    $url = $input['next'];
                                    $this->request_1($url);
                                    //$this->request_j($url);
                                    sleep(random_int(1,2));
                                    $url = $host.'/get_audio_captcha/?callback='.$call_back_label.'&_='.time();
                                    $result = $this->request_i($url);
                                    $url = $host.$result->data;
                                    $this->request_l($url);
                                    sleep(random_int(1,2));
                                    $captcha = $this->request_d();
                                    unlink($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
                                    $input['next'] = str_replace('&amp;', '&', $input['next']);
                                    $url = $input['next'].'&code='.urlencode($captcha);
                                    $result = $this->request_j($url);
                                    $input = $this->request_r($result, $input);
                                }
                            } else {
                                return $this->config_error_message(905);
                            }
                            return json_encode($input);
                        }
                    } else {
                        /*не прошел запрос*/
                        return $this->config_error_message(302);
                    }
                } else {
                    return $this->config_error_message(703);
                }
            } else {
                return $this->config_error_message(702);
            }
        } else {
            return $this->config_error_message(701);
        }
    }

    protected function config_error_message($code){
        if (isset($this->errors_messages[$code])){
            LogSearch::create(['status' => 'Ошибка','code'=>$this->errors_messages[$code]['code'], 'message'=>$this->errors_messages[$code]['label'], 'time' => now()]);
            return json_encode(array('error'=>true, 'message'=>$this->errors_messages[$code]['code'], 'info'=>$this->errors_messages[$code]['label']));
        }else{
            LogSearch::create(['status' => 'Ошибка', 'code'=>$this->errors_messages[0]['code'], 'message'=>$this->errors_messages[0]['label'], 'time' => now()]);
            return json_encode(array('error'=>true, 'message'=>$this->errors_messages[0]['code'], 'info'=>$this->errors_messages[0]['label']));
        }
    }

    protected function get_search_result($host, $call_back_label){
        $url = $host . '/get_audio_captcha/?callback=' . $call_back_label . '&_=' . time();
        $result = $this->request_i($url);
        $url = $host . $result->data;
        $this->request_l($url);
        sleep(random_int(1,2));
        $captcha = $this->request_d();
        $url = $host
            .'/ajax_search?=&=&system=ip&is[extended]=1&nocache=1&is[variant]='
            . $this->variant.'&is[region_id][0]='
            . $this->region_id.'&is[last_name]='
            . $this->last_name.'&is[first_name]='
            . $this->first_name.'&is[drtr_name]='
            . $this->drtr_name.'&is[ip_number]='
            . $this->ip_number.'&is[patronymic]='
            . $this->patronymic.'&is[date]='
            . $this->date.'&is[address]='
            . $this->address.'&is[id_number]='
            . $this->id_number.'&is[id_type][0]='
            . $this->id_type.'&is[id_issuer]='
            . $this->id_issuer.'&is[inn]='
            . $this->inn.'&callback='
            . $call_back_label
            . '&code='
            . urlencode($captcha)
            . '&_='.time();
        $result = $this->request_j($url);
        return $result;
    }

    protected function set_cf($data){
//        dd($data);
        if ($this->search_type == 1) { /*по номеру*/
            $this->ip_number = urlencode($data["ip_number"]);
            $this->variant = 3;
         } else if ($this->search_type == 2) { /*физ лица*/
            $this->region_id = $data["region_id"];
            $this->last_name = urlencode($data["last_name"]);
            $this->first_name = urlencode($data["first_name"]);
            $this->patronymic = urlencode($data["patronymic"]);
            $this->date = $data["date"];
            $this->variant = 1;
        } else if ($this->search_type == 3) { /*по ИНН юл*/
            $this->inn = $data["inn_number"];
            $this->variant = 5;
        } else if ($this->search_type == 4) { /*по юл*/
            $this->variant = 2;
            $this->address = urlencode($data["address"]);
            $this->drtr_name = urlencode($data["name"]);
            $this->region_id = $data["region_id"];
        } else if ($this->search_type == 5) {
            $this->variant = 4;
            $this->region_id = $data["region_id"];
            $this->id_number = urlencode($data["id_number"]);
            $this->id_issuer = urlencode($data["id_issuer"]);
            $this->id_type = $data["id_type"];
        }
        return true;
    }

    protected function request_i($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = 'User-Agent: '.$_SERVER['HTTP_USER_AGENT'];
        $headers[] = 'Accept: */*';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip, deflate, br';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Cookie: '.$this->matches;
        $headers[] = 'Referer: https://fssp.gov.ru/';
        $headers[] = 'Sec-Fetch-Dest: script';
        $headers[] = 'Sec-Fetch-Mode: no-cors';
        $headers[] = 'Sec-Fetch-Site: same-sit';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = substr($result, strpos($result, "{"), strlen($result)-strpos($result, "{"));
        $result = substr($result, 0, strpos($result, ");"));
        return json_decode($result);
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

    protected function request_1($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = "User-Agent: ".$_SERVER['HTTP_USER_AGENT'];
        $headers[] = "Accept: */*";
        $headers[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3";
        $headers[] = "Accept-Encoding: gzip, deflate, br";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Referer: https://fssp.gov.ru/";
        $headers[] = "Sec-Fetch-Dest: script";
        $headers[] = "Sec-Fetch-Mode: no-cors";
        $headers[] = "Sec-Fetch-Site: same-site";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $c_info = substr($result, 0, $header_size);
        curl_close($ch);
        if (strpos($result, '<img src=')>0){
            $result = substr($result, strpos($result, '<img src=')+strlen('<img src='), strlen($result)-(strpos($result, '<img src=')+strlen('<img src=')));
            $result = substr($result, 0, strpos($result, ' id='));
            $result = str_replace('\"', '', $result);
        }else{
            $result = '';
        }
        $matches_ar = array();
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $c_info, $matches_ar);
        if (!isset($matches_ar[1][0])){
            return false;
        }
        $this->matches = $matches_ar[1][0];
        return array('image' => $result, 'cookie' => $matches_ar[1][0]);
    }

    protected function request_c(){
        $params = array('func'=>'get_call_back_label', 'token' => $this->token, 'ip' => $this->ip, 'search_type' => $this->search_type);
//        return $params;
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

    protected function request_l($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = 'Accept: audio/webm,audio/ogg,audio/wav,audio/*;q=0.9,application/ogg;q=0.7,video/*;q=0.6,*/*;q=0.5';
        $headers[] = 'Accept-Encoding: identity';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Cookie: '.$this->matches;
        $headers[] = 'Host: '.$this->is_node;
        $headers[] = 'Range: bytes=0-';
        $headers[] = 'Referer: https://fssp.gov.ru/';
        $headers[] = 'Sec-Fetch-Dest: audio';
        $headers[] = 'Sec-Fetch-Mode: no-cors';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'User-Agent: '.$_SERVER['HTTP_USER_AGENT'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav', 'w');
        fwrite($fp, $result);
        fclose($fp);
    }

    protected function request_d(){
        $params = array('func'=>'upload_file', 'token' => $this->token, 'ip' => $this->ip);
        $a_url = $this->api_url . '?' . http_build_query($params);
        $cf = new \CURLFile($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $a_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ["upload" => $cf]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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
        if ($result->error == 'false')
        {
            return $result->word;
        }else{
            return '1245';
        }
    }

    protected function request_j($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array();
        $headers[] = 'User-Agent: '.$_SERVER['HTTP_USER_AGENT'];
        $headers[] = 'Accept: */*';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip, deflate, br';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Referer: https://fssp.gov.ru/';
        $headers[] = 'Cookie: '.$this->matches;
        $headers[] = 'Sec-Fetch-Dest: script';
        $headers[] = 'Sec-Fetch-Mode: no-cors';
        $headers[] = 'Sec-Fetch-Site: same-site';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    protected function request_r($result, $input) {
        mb_internal_encoding("UTF-8");
        if (mb_strpos($result, ");") > 0){
            $result = mb_substr($result, mb_strpos($result, "{"), mb_strlen($result)-mb_strpos($result, "{"), "utf-8");
            $result = mb_substr($result, 0, mb_strpos($result, ");"), "utf-8");
        }
//        dd($result);
        $result = json_decode($result);
        if (isset($result->data)) {
            if (mb_strpos($result->data, 'По вашему запросу ничего не найдено') > 0) {
                return $this->config_error_message(404);
            } else {
                if ($this->search_type > 0) {
                    if (mb_strpos($result->data, '<tr') > 0) {
                        $result = $result->data;
                        $header = $input['header'];
                        $body = $input['body'];
                        $result = str_replace("> ", ">", $result);
                        $result = str_replace(" <", "<", $result);
                        while(mb_strpos($result, '<th') > 0) {
                            $result = mb_substr($result, mb_strpos($result, '<th') + 1, mb_strlen($result)-mb_strpos($result, '<th') + 1, "utf-8");
                            $result = mb_substr($result, mb_strpos($result, '>') + 1, mb_strlen($result)-mb_strpos($result, '>') + 1, "utf-8");
                            $word = mb_substr($result, 0, mb_strpos($result, '</th'), "utf-8");
                            $word = mb_ereg_replace('[ ]+', ' ', $word);
                            $word = str_replace(PHP_EOL, '', $word);

                            if (mb_strpos($word, '<span') > 1) $word = mb_substr($word, 0, mb_strpos($word, '<span'), "utf-8");
                            if ($word[0].$word[1] == '  ') $word = mb_substr($word, 2);
                            if (count($header) < 8) $header[] = $word;

                        }
                        while(mb_strpos($result, '<td') > 0) {
                            if (!mb_strpos($result, '<td colspan="8"')) {
                                $result = mb_substr($result, mb_strpos($result, '<td') + 1, mb_strlen($result)-mb_strpos($result, '<td') + 1);
                                $result = mb_substr($result, mb_strpos($result, '>') + 1, mb_strlen($result)-mb_strpos($result, '>') + 1);
                                $word = mb_substr($result, 0, mb_strpos($result, '</td'));
                                $word = mb_substr($result, 0, mb_strpos($result, '</td'));
                                $word = str_replace(PHP_EOL, '', $word);
                                $word = mb_ereg_replace('[ ]+', ' ', $word);
                                $body[] = $word;
                            } else {
                                $result = mb_substr($result, mb_strpos($result, '<td') + 1, mb_strlen($result)-mb_strpos($result, '<td') + 1);
                                $result = mb_substr($result, mb_strpos($result, '>') + 1, mb_strlen($result)-mb_strpos($result, '>') + 1);
                            }
                        }
                        $next_url='';
                        if (mb_strpos($result, '">Следующая</a>') > 0) {
                            $stop_next = mb_strpos($result, '">Следующая</a>');
                            $start_next = mb_strpos($result, 'https', 0 - $stop_next);
                            if ($start_next > 0) {
                                $next_url = mb_substr($result, $start_next, mb_strpos($result, '"', $start_next + 1) - $start_next);
                            }
                        }
                        return array('error'=>false, 'header'=>$header, 'body'=>$body, 'next'=>$next_url);
                    }
                } else {
                    $result = $result->data;
                    $result = substr($result, strpos($result, '<table'), strlen($result)-strpos($result, 'table'));
                    $result = substr($result, 0, strpos($result, '</table>'));
                    return $result;
                }
            }
        } else {
            return $this->config_error_message(301);
        }
    }

    protected function request_m($token, $image){
        $params = array('func'=>'missing_capcha', 'token' => $token, 'ip' => $this->ip);
        $a_url = $this->api_url . '?' . http_build_query($params);
        $cf = new \CURLFile($_SERVER['DOCUMENT_ROOT'].'/in/'.$this->tm.'.wav');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $a_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ["upload" => $cf, "image" => $image]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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
        return $result->message;
    }

    public function request_a(){
        $result = $this->request_b();
        if ($result->error == true || $result->error == 'true'){
            $token = $this->request_t();
            if ($token->error == 'false' || $token->error == false) {
                $this->token = $token->token;
                $token = Setting::all()->first();
                $collection = new Collection(["token" => $this->token, "date" => date("d.m.Y")]);
                $token->update(["token" => $collection->toJson()]);
            }
            $result = $this->request_b();
        }
        return $result;
    }

    protected function request_b(){
        $params = array('func'=>'get_amount', 'token' => $this->token, 'ip' => $this->ip);
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

    protected function get_config($value = 'FSSP_PRODUCT_KEY'){        
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/../.env')){
            $stroke = '';
            $word = '';
            $f = fopen($_SERVER['DOCUMENT_ROOT'].'/../.env','r');
            while (!feof($f))
            {
                $stroke = fgets($f);
                $pos = mb_strpos($stroke, $value);
                if ($pos !== false){
                    $stroke = str_replace(array("\r", "\n", "\"", $value.'='), '', $stroke);
                    fclose($f);
                    return $stroke;
                }
            }
            fclose($f);
            return null;
        }else{
            return null;
        }
        $config = file_get_contents('../../../.env');
    }
}
