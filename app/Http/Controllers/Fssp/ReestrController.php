<?php

namespace App\Http\Controllers\Fssp;

use App\Http\Controllers\Controller;
use App\Exports\ReestrExport;
use App\Http\Helpers\Fssp;
use App\Imports\ReestrImport;
use App\Models\Fssp\ErrorHistoriSearchReestr;
use App\Models\Fssp\HistoriSearchReestrId;
use App\Models\Fssp\LogSearch;
use App\Models\Fssp\Reestr;
use App\Models\Fssp\CreditName;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use function Sodium\increment;

class ReestrController extends Controller
{
    private $regions = array(array('id'=>"02", 'value' =>'Республика Башкортостан'), array('id'=>"03", 'value' =>'Республика Бурятия'), array('id'=>"04", 'value' =>'Республика Алтай'), array('id'=>"05", 'value' =>'Республика Дагестан'), array('id'=>"06", 'value' =>'Республика Ингушетия'), array('id'=>"07", 'value' =>'Кабардино-Балкария'), array('id'=>"08", 'value' =>'Республика Калмыкия'), array('id'=>"09", 'value' =>'Карачаево-Черкесия'), array('id'=>"10", 'value' =>'Республика Карелия'), array('id'=>"11", 'value' =>'Республика Коми'), array('id'=>"12", 'value' =>'Республика Марий Эл'), array('id'=>"13", 'value' =>'Республика Мордовия'), array('id'=>"14", 'value' =>'Республика Саха (Якутия)'), array('id'=>"15", 'value' =>'Северная Осетия-Алания'), array('id'=>"16", 'value' =>'Республика Татарстан'), array('id'=>"17", 'value' =>'Республика Тыва'), array('id'=>"18", 'value' =>'Удмуртская Республика'), array('id'=>"19", 'value' =>'Республика Хакасия'), array('id'=>"20", 'value' =>'Чеченская Республика'), array('id'=>"21", 'value' =>'Чувашская Республика - Чувашия'), array('id'=>"22", 'value' =>'Алтайский край'), array('id'=>"23", 'value' =>'Краснодарский край'), array('id'=>"24", 'value' =>'Красноярский край'), array('id'=>"25", 'value' =>'Приморский край'), array('id'=>"26", 'value' =>'Ставропольский край'), array('id'=>"27", 'value' =>'Хабаровский край и Еврейская автономная область'), array('id'=>"28", 'value' =>'Амурская область'), array('id'=>"29", 'value' =>'Архангельская область и Ненецкий автономный округ'), array('id'=>"30", 'value' =>'Астраханская область'), array('id'=>"31", 'value' =>'Белгородская область'), array('id'=>"32", 'value' =>'Брянская область'), array('id'=>"33", 'value' =>'Владимирская область'), array('id'=>"34", 'value' =>'Волгоградская область'), array('id'=>"35", 'value' =>'Вологодская область'), array('id'=>"36", 'value' =>'Воронежская область'), array('id'=>"37", 'value' =>'Ивановская область'), array('id'=>"38", 'value' =>'Иркутская область'), array('id'=>"39", 'value' =>'Калининградская область'), array('id'=>"40", 'value' =>'Калужская область'), array('id'=>"41", 'value' =>'Камчатский край и Чукотский автономный округ'), array('id'=>"42", 'value' =>'Кемеровская область - Кузбасс'), array('id'=>"43", 'value' =>'Кировская область'), array('id'=>"44", 'value' =>'Костромская область'), array('id'=>"45", 'value' =>'Курганская область'), array('id'=>"46", 'value' =>'Курская область'), array('id'=>"47", 'value' =>'Ленинградская область'), array('id'=>"48", 'value' =>'Липецкая область'), array('id'=>"49", 'value' =>'Магаданская область'), array('id'=>"50", 'value' =>'Московская область'), array('id'=>"51", 'value' =>'Мурманская область'), array('id'=>"52", 'value' =>'Нижегородская область'), array('id'=>"53", 'value' =>'Новгородская область'), array('id'=>"54", 'value' =>'Новосибирская область'), array('id'=>"55", 'value' =>'Омская область'), array('id'=>"56", 'value' =>'Оренбургская область'), array('id'=>"57", 'value' =>'Орловская область'), array('id'=>"58", 'value' =>'Пензенская область'), array('id'=>"59", 'value' =>'Пермский край'), array('id'=>"60", 'value' =>'Псковская область'), array('id'=>"61", 'value' =>'Ростовская область'), array('id'=>"62", 'value' =>'Рязанская область'), array('id'=>"63", 'value' =>'Самарская область'), array('id'=>"64", 'value' =>'Саратовская область'), array('id'=>"65", 'value' =>'Сахалинская область'), array('id'=>"66", 'value' =>'Свердловская область'), array('id'=>"67", 'value' =>'Смоленская область'), array('id'=>"68", 'value' =>'Тамбовская область'), array('id'=>"69", 'value' =>'Тверская область'), array('id'=>"70", 'value' =>'Томская область'), array('id'=>"71", 'value' =>'Тульская область'), array('id'=>"72", 'value' =>'Тюменская область'), array('id'=>"73", 'value' =>'Ульяновская область'), array('id'=>"74", 'value' =>'Челябинская область'), array('id'=>"75", 'value' =>'Забайкальский край'), array('id'=>"76", 'value' =>'Ярославская область'), array('id'=>"77", 'value' =>'Москва'), array('id'=>"78", 'value' =>'Санкт-Петербург'), array('id'=>"80", 'value' =>'Донецкая Народная Республика'), array('id'=>"81", 'value' =>'Луганская Народная Республика'), array('id'=>"82", 'value' =>'Республика Крым и Севастополь'), array('id'=>"84", 'value' =>'Херсонская область'), array('id'=>"85", 'value' =>'Запорожская область'), array('id'=>"86", 'value' =>'Ханты-Мансийский АО'), array('id'=>"89", 'value' =>'Ямало-Ненецкий АО'));

    public function index() {
        return $this->reestrAll();
    }

    public function searchTheReestr()
    {
        $reestrsAll = Reestr::all();
        if (count($reestrsAll) > 0) {
            $header = $reestrsAll->first()->line;
            $reestrs = $reestrsAll->where('id', '>' , 1);
            foreach ($reestrs as $reestr) {
                foreach ($this->regions as $region) {
                    if ($region['id'] == $reestr->region_id){
                        $reestr->region_id = $region['value'];
                        break;
                    }
                }
                $reestr->credit = 'Долг:'.$reestr->credit.' Удержано:'.$reestr->real_credit.' Итог:'.$reestr->credit-$reestr->real_credit;
                if ($reestr->birthdate == '01.01.1970'){
                    $reestr->birthdate = '-';
                }
            }
            $collect = new Collection(json_encode($header));
//            return $collect;
            return ['header' => $header, 'reestrs' => $reestrs->toArray()];
        }
        return false;
    }

    public function store(Request $request) {
        $data = [
            'ip_number' => $request->number_ip,
            'id_number' => $request->number_id,
            'fio' => $request->fio,
            'birthdate' => $request->birthdate,
            'inn' => $request->number_inn,
            'header' => false
        ];
        if (Reestr::create($data)) {
            return json_encode(['error' => false]);
        } else {
            return json_encode(['error' => true]);
        }
    }

    public function reestrImport(Request $request) {
        DB::table('reestrs')->delete();
        DB::statement("ALTER TABLE reestrs AUTO_INCREMENT = 1");

        if (Excel::import(new ReestrImport(), $request->file('file'))) {
            $reestr = $this->reestrAll();
            $data = new Collection(['error' => false, 'message' => 'Реестр успешно загружен', 'reestr' => $reestr]);
            return $data->toJson();
        }

        $data = new Collection(['error' => true, 'message' => 'Произошла ошибка, в реестр ни чего не загружено', 'reestr' => []]);
        return $data->toJson();

    }

    public function reestrExport() {
        return Excel::download(new ReestrExport(), 'reestr.xlsx');
    }

    public function searchReestrs(Request $request, Fssp $fssp) {
        $reestr = Reestr::find(['id' => $request->data])->first();
        $data = null;
        if ($reestr->upload_error == 0) {
            /*Поиск по номеру ИП*/
            if (isset($reestr->ip_number) && $reestr->ip_number!=''){
                $data = json_decode($this->searchByIp($reestr, $fssp));
                if ($data->error == false && isset($data->body)) {
                    $data = $this->parseArrayData($data);
                    foreach ($data['data'] as $item)
                    {
                        $fio = $this->check_dolgn($reestr, $item[0]['data']);
                        if (mb_strpos(mb_strtolower($fio), mb_strtolower($reestr->fio)) !== false) {
                            $this->save_results($reestr, $item);
                            $status = $item[3]['data'];
                            $line = json_encode([$item[0]['data'], $item[1]['data'], $item[2]['data'], $item[3]['data'], $item[5]['data'], $item[6]['data'], $item[7]['data']]);
                            if(is_null(HistoriSearchReestrId::where([['id_number', '=', $reestr->id_number],['line', '=', $line]])->first())) {
                                $data = HistoriSearchReestrId::create([
                                    'id_number' => $reestr->id_number,
                                    'fio'       => $reestr->fio,
                                    'birthdate' => $reestr->birthdate,
                                    'inn'       => $reestr->inn,
                                    'status'    => $status,
                                    'credit'    => $reestr->real_credit,
                                    'line'      => $line,
                                    'header'    => 0
                                ]);
                            }
                            if ($status != ""){
                                //если закрыто поиск по номеру ИД
                                /******************************************/
                                $data = json_decode($this->searchById($reestr, $fssp));
                                if ($data->error == false && isset($data->body) && $data->body[3]=="") {
                                    $data = $this->parseArrayData($data);
                                    foreach ($data['data'] as $item)
                                    {
                                        $fio = $this->check_dolgn($reestr, $item[0]['data']);
                                        $find = false;
                                        if (is_null($reestr->inn)) {
                                            if (mb_strpos(mb_strtolower($item[0]['data']), mb_strtolower($reestr->fio))!==false && mb_strpos(mb_strtolower($fio), mb_strtolower($reestr->birthdate))) {
                                                $find = true;
                                            }
                                        } else {
                                            if (mb_strpos(mb_strtolower($item[0]['data']), mb_strtolower($reestr->fio))!==false && mb_strpos(mb_strtolower($fio), mb_strtolower($reestr->inn))) {
                                                $find = true;
                                            }
                                        }
                                        if ($find) {
                                            $this->save_results($reestr, $item);
                                            $status = $item[3]['data'];
                                            $line = json_encode([$item[0]['data'], $item[1]['data'], $item[2]['data'], $item[3]['data'], $item[5]['data'], $item[6]['data'], $item[7]['data']]);
                                            if(is_null(HistoriSearchReestrId::where([['id_number', '=', $reestr->id_number],['line', '=', $line]])->first())) {
                                                $data = HistoriSearchReestrId::create([
                                                    'id_number' => $reestr->id_number,
                                                    'fio'       => $reestr->fio,
                                                    'birthdate' => $reestr->birthdate,
                                                    'inn'       => $reestr->inn,
                                                    'status'    => $status,
                                                    'credit'    => $reestr->real_credit,
                                                    'line'      => $line,
                                                    'header'    => 0
                                                ]);
                                            }
                                            break;
                                        }else{
                                            ErrorHistoriSearchReestr::create(['code' => 440044, 'message' => 'Не совпадает Должник в ИП', 'reestr_id' => $reestr->id, 'time' => now()]);
                                        }
                                    }
                                } else {
                                    ErrorHistoriSearchReestr::create(['code' => $data->message, 'message' => $data->info, 'reestr_id' => $reestr->id, 'time' => now()]);
                                }
                                /******************************************/
                            }else{
                                break;
                            }
                        }
                    }
                } else {
                    ErrorHistoriSearchReestr::create(['code' => $data->message, 'message' => $data->info, 'reestr_id' => $reestr->id, 'time' => now()]);
                }
            } else {
                //поиск по номеру ИД
                $data = json_decode($this->searchById($reestr, $fssp));
                if ($data->error == false && isset($data->body)) {
                    $data = $this->parseArrayData($data);
                    foreach ($data['data'] as $item)
                    {
                        if ($item[3]['data'] === "") {
                            $fio = $this->check_dolgn($reestr, $item[0]['data']);
                            $find = false;
                            if (is_null($reestr->inn)) {
                                if (mb_strpos(mb_strtolower($item[0]['data']), mb_strtolower($reestr->fio))!==false && mb_strpos(mb_strtolower($item[0]['data']), mb_strtolower($reestr->birthdate))) {
                                    $find = true;
                                }
                            } else {
                                if (mb_strpos(mb_strtolower($item[0]['data']), mb_strtolower($reestr->fio))!==false && mb_strpos(mb_strtolower($item[0]['data']), mb_strtolower($reestr->inn))) {
                                    $find = true;
                                }
                            }
                            if ($find) {
                                $this->save_results($reestr, $item);
                                $status = $item[3]['data'];
                                $line = json_encode([$item[0]['data'], $item[1]['data'], $item[2]['data'], $item[3]['data'], $item[5]['data'], $item[6]['data'], $item[7]['data']]);
                                if(is_null(HistoriSearchReestrId::where([['id_number', '=', $reestr->id_number],['line', '=', $line]])->first())) {
                                    $data = HistoriSearchReestrId::create([
                                        'id_number' => $reestr->id_number,
                                        'fio'       => $reestr->fio,
                                        'birthdate' => $reestr->birthdate,
                                        'inn'       => $reestr->inn,
                                        'status'    => $status,
                                        'credit'    => $reestr->real_credit,
                                        'line'      => $line,
                                        'header'    => 0
                                    ]);
                                }
                                break;
                            }
                        } else {

                        }
                    }
                } else {
                    ErrorHistoriSearchReestr::create(['code' => $data->message, 'message' => $data->info, 'reestr_id' => $reestr->id, 'time' => now()]);
                }
            }
        }
        return $data;
    }

    public function delete() {
        if ($table = DB::table('reestrs')->delete()) {
            DB::statement("ALTER TABLE reestrs AUTO_INCREMENT = 1");
            return ['message' => 'Реестр успещно удален'];
        }
        return ['message' => 'Произошла ошибка, обратитесть к админестратору сайта'];

    }

    private function parseArrayData($data) {
        $new_data = [];
        $array_data = [];
        $count = 0;
//        dd($data);
        if (isset($data->header) && isset($data->body)) {
            for ($i = 1; $i <= count($data->body); $i++) {
                if ($count <= 7) {
                    array_push($new_data, ['title' => $data->header[$count], 'data' => $data->body[$i - 1]]);
                    $count++;
                }
                if ($count > 7) {
                    array_push($array_data, $new_data);
                    $new_data = [];
                    $count = 0;
                }
            }
            $data = new Collection(['error' => false, 'data' => $array_data]);
        } else {
            $data = ['error' => true, 'message' => 'Произошла ошибка, повторите попытку через несколько минут'];
        }

        return $data;
    }

    private function parseCredit($string){
        $credit = explode("<br />", $string);
        $total = 0;
        if (count($credit)==0){
            $credit = explode("<br>", $string);
        }
        $credit_array = array();
        foreach ($credit as $line) {
            if ($line!=''){
                $line = explode(":", $line);
                if (count($line)>1){
                    $credit_name = Credit_name::find(['name' => $line[0]])->first();
                    if (is_null($credit_name)){
                        $credit_name = new Credit_name();
                        $credit_name->name = $line[0];
                        if (mb_strpos($line[0], 'Исполнительский сбор')===false){
                            $credit_name->type = 0;
                        }else{
                            $credit_name->type = 1;
                        }
                        $credit_name->save();
                    }
                    $line[1] = str_replace(' руб.', '', $line[1]);
                    $line[1] = str_replace('руб.', '', $line[1]);
                    $line[1] = str_replace(' руб', '', $line[1]);
                    $line[1] = str_replace('руб', '', $line[1]);
                    $line[1] = (float) $line[1];
                    $total += $line[1];
                    $credit_array[]=array($credit_name->id => $line[1]);
                }
            }
        }
        //return json_encode($credit_array);
        return $total;
    }

    private function if_date($date){
        return preg_match("/^[0-9]{1,2}.[0-9]{1,2}.[0-9]{4}$/", $date);
    }

    private function check_dolgn($reestr, $dolgn){
        $arrayFio = explode("<br>", $dolgn);
        if (count($arrayFio)>1){
            if ($this->if_date($arrayFio[1])){
                if (is_null($reestr->birthdate) || $reestr->birthdate=='01.01.1970' || $reestr->birthdate==''){
                    $reestr->birthdate = $arrayFio[1];
                    $reestr->save();
                }
            }else{
                if (is_null($reestr->inn) || $reestr->inn==''){
                    $reestr->inn = $arrayFio[count($arrayFio)-1];
                    $line = json_decode($reestr->line);
                    $reestr->save();
                }
            }
        }
        return $arrayFio[0];
    }

    private function save_results($reestr, $item){
        if (count($item)>0){
            $ip_number = explode(" от ", $item[1]["data"])[0];
            if ($reestr->ip_number != $ip_number){
                $reestr->ip_number = $ip_number;
            }
            $reestr->state = $this->get_state($item[3]['data']);
            $real_credit = $this->parseCredit($item[5]['data']);
            $reestr->real_credit = $real_credit;
            $reestr->difference = (float)$reestr->credit - (float)$real_credit;
            $osp = $item[6]['data'];
            $spi = $item[7]['data'];
            $reestr->save();
        }
    }

    private function get_state($val){
        $state = 'В исполнении ФССП';
        if (strpos($val, 'ст. 46') !== false || strpos($val, 'ст.46') !== false){
            $state = 'Окончено (с Актом)';
        }else if(strpos($val, 'ст. 47') !== false || strpos($val, 'ст.47') !== false){
            if (strpos($val, 'п. 6') !== false || strpos($val, 'п.6') !== false){
                $state = 'Окончено (Ликвидация)';
            }elseif (strpos($val, 'п. 1') !== false || strpos($val, 'п.1') !== false) {
                $state = 'Окончено (Фактом)';
            }elseif (strpos($val, 'п. 7') !== false || strpos($val, 'п.7') !== false) {
                $state = 'Окончено (Банкрот)';
            }
        }else if(strpos($val, 'ст. 33') !== false || strpos($val, 'ст.33') !== false){
            $state = 'Передано в другой ОСП';
        }else if(strpos($val, 'ст. 43') !== false || strpos($val, 'ст.43') !== false){
            $state = 'Прекращено';
        }
        return $state;
    }

    private function searchByIp($reestr, $fssp){
        $fssp->search_type = 1;
        return $fssp->test(['ip_number' => $reestr->ip_number]);
    }

    private function searchById ($reestr, $fssp) {
        $fssp->search_type = 5;
        return $fssp->test(['id_number' => $reestr->id_number, 'id_issuer' => '', 'region_id' => $reestr->region_id, 'id_type' => '']);
    }

    private function reestrAll()
    {
        $reestrsAll = Reestr::all();
        if (count($reestrsAll) > 0) {
            $header = $reestrsAll->first()->line;
            $reestrs = $reestrsAll->where('id', '>' , 1);
            foreach ($reestrs as $reestr) {
                foreach ($this->regions as $region) {
                    if ($region['id'] == $reestr->region_id){
                        $reestr->region_id = $region['value'];
                        break;
                    }
                }
                $reestr->credit = 'Долг:'.$reestr->credit.' Удержано:'.$reestr->real_credit.' Итог:'.$reestr->credit-$reestr->real_credit;
                if ($reestr->birthdate == '01.01.1970'){
                    $reestr->birthdate = '-';
                }
            }
            $collect = new Collection(json_encode($header));
//            return $reestrs;
            return new Collection(['header' => $header, 'reestrs' => $reestrs->toArray()]);
        }
        return false;
    }
}


