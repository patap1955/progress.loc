<?php

namespace App\Imports;

use App\Models\Fssp\Reestr;
use App\Models\Fssp\Fssp_reestr_fields;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReestrImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private int $rows  = 0 ;
    private int $fio = 0;
    private null|int $birthdate = null;
    private null|int $inn = null;
    private null|int $ipKey = null;
    private null|int $idKey = null;
    private int $idRegion = 0;
    private $headers;
    private $data;
    private $array_header = [];

    private $regions = array(array('id'=>"02", 'value' =>'Республика Башкортостан'), array('id'=>"03", 'value' =>'Республика Бурятия'), array('id'=>"04", 'value' =>'Республика Алтай'), array('id'=>"05", 'value' =>'Республика Дагестан'), array('id'=>"06", 'value' =>'Республика Ингушетия'), array('id'=>"07", 'value' =>'Кабардино-Балкария'), array('id'=>"08", 'value' =>'Республика Калмыкия'), array('id'=>"09", 'value' =>'Карачаево-Черкесия'), array('id'=>"10", 'value' =>'Республика Карелия'), array('id'=>"11", 'value' =>'Республика Коми'), array('id'=>"12", 'value' =>'Республика Марий Эл'), array('id'=>"13", 'value' =>'Республика Мордовия'), array('id'=>"14", 'value' =>'Республика Саха (Якутия)'), array('id'=>"15", 'value' =>'Северная Осетия-Алания'), array('id'=>"16", 'value' =>'Республика Татарстан'), array('id'=>"17", 'value' =>'Республика Тыва'), array('id'=>"18", 'value' =>'Удмуртская Республика'), array('id'=>"19", 'value' =>'Республика Хакасия'), array('id'=>"20", 'value' =>'Чеченская Республика'), array('id'=>"21", 'value' =>'Чувашская Республика - Чувашия'), array('id'=>"22", 'value' =>'Алтайский край'), array('id'=>"23", 'value' =>'Краснодарский край'), array('id'=>"24", 'value' =>'Красноярский край'), array('id'=>"25", 'value' =>'Приморский край'), array('id'=>"26", 'value' =>'Ставропольский край'), array('id'=>"27", 'value' =>'Хабаровский край и Еврейская автономная область'), array('id'=>"28", 'value' =>'Амурская область'), array('id'=>"29", 'value' =>'Архангельская область и Ненецкий автономный округ'), array('id'=>"30", 'value' =>'Астраханская область'), array('id'=>"31", 'value' =>'Белгородская область'), array('id'=>"32", 'value' =>'Брянская область'), array('id'=>"33", 'value' =>'Владимирская область'), array('id'=>"34", 'value' =>'Волгоградская область'), array('id'=>"35", 'value' =>'Вологодская область'), array('id'=>"36", 'value' =>'Воронежская область'), array('id'=>"37", 'value' =>'Ивановская область'), array('id'=>"38", 'value' =>'Иркутская область'), array('id'=>"39", 'value' =>'Калининградская область'), array('id'=>"40", 'value' =>'Калужская область'), array('id'=>"41", 'value' =>'Камчатский край и Чукотский автономный округ'), array('id'=>"42", 'value' =>'Кемеровская область - Кузбасс'), array('id'=>"43", 'value' =>'Кировская область'), array('id'=>"44", 'value' =>'Костромская область'), array('id'=>"45", 'value' =>'Курганская область'), array('id'=>"46", 'value' =>'Курская область'), array('id'=>"47", 'value' =>'Ленинградская область'), array('id'=>"48", 'value' =>'Липецкая область'), array('id'=>"49", 'value' =>'Магаданская область'), array('id'=>"50", 'value' =>'Московская область'), array('id'=>"51", 'value' =>'Мурманская область'), array('id'=>"52", 'value' =>'Нижегородская область'), array('id'=>"53", 'value' =>'Новгородская область'), array('id'=>"54", 'value' =>'Новосибирская область'), array('id'=>"55", 'value' =>'Омская область'), array('id'=>"56", 'value' =>'Оренбургская область'), array('id'=>"57", 'value' =>'Орловская область'), array('id'=>"58", 'value' =>'Пензенская область'), array('id'=>"59", 'value' =>'Пермский край'), array('id'=>"60", 'value' =>'Псковская область'), array('id'=>"61", 'value' =>'Ростовская область'), array('id'=>"62", 'value' =>'Рязанская область'), array('id'=>"63", 'value' =>'Самарская область'), array('id'=>"64", 'value' =>'Саратовская область'), array('id'=>"65", 'value' =>'Сахалинская область'), array('id'=>"66", 'value' =>'Свердловская область'), array('id'=>"67", 'value' =>'Смоленская область'), array('id'=>"68", 'value' =>'Тамбовская область'), array('id'=>"69", 'value' =>'Тверская область'), array('id'=>"70", 'value' =>'Томская область'), array('id'=>"71", 'value' =>'Тульская область'), array('id'=>"72", 'value' =>'Тюменская область'), array('id'=>"73", 'value' =>'Ульяновская область'), array('id'=>"74", 'value' =>'Челябинская область'), array('id'=>"75", 'value' =>'Забайкальский край'), array('id'=>"76", 'value' =>'Ярославская область'), array('id'=>"77", 'value' =>'Москва'), array('id'=>"78", 'value' =>'Санкт-Петербург'), array('id'=>"80", 'value' =>'Донецкая Народная Республика'), array('id'=>"81", 'value' =>'Луганская Народная Республика'), array('id'=>"82", 'value' =>'Республика Крым и Севастополь'), array('id'=>"84", 'value' =>'Херсонская область'), array('id'=>"85", 'value' =>'Запорожская область'), array('id'=>"86", 'value' =>'Ханты-Мансийский АО'), array('id'=>"89", 'value' =>'Ямало-Ненецкий АО'));
     private $stop_words = array('Республика','край','автономный округ', 'область');

    public function model(array $row)
    {
        $newCollect = [];
        $data = [];
        if ($this->rows === 0) {
            $reestr_fields = Fssp_reestr_fields::all();
            $i = 0;
            foreach ($reestr_fields as $field) {
                array_push($data, $field->name);
                $i++;
            }
            $sub_collect = [];
            foreach ($row as $key => $val) {
                $find = 0;
                $i = 0;
                foreach ($reestr_fields as $field) {
                    if($val !== null && mb_strtolower($val) == mb_strtolower($field->name)) {
                        $this->array_header[$key] = $i;
                        $find = 1;
                        switch ($field->name) {
                            case 'Должник*':
                                $this->fio = $key;
                                break;
                            case 'Дата рождения (физ. лица)':
                                $this->birthdate = $key;
                                break;
                            case 'ИНН (юр. лица)':
                                $this->inn = $key;
                                break;
                            case 'Исполнительное производство (номер)':
                                $this->ipKey = $key;
                                break;
                            case 'Исполнительный документ (номер)*':
                                $this->idKey = $key;
                                break;
                            case 'Регион*':
                                $this->idRegion = $key;
                                break;
                        }

                    }
                    $i++;
                }
                if ($find == 0 && $val !== null){
                    array_push($data, $val);
                    array_push($sub_collect, $key);
                }
            }
            foreach ($sub_collect as $field) {
                $this->array_header[$field] = count($this->array_header);
            }
            $collect = new Collection($data);
            $data = [
                "line"   => $collect->toJson(),
                'header' => true,
            ];
        } else {
            $newData = [];
            $collect = [];
            $sub_collect = [];
            $upload_error = false;

            foreach ($row as $key => $val) {
                switch ($key) {
                    case $this->fio:
                        $newData['fio'] = $val;
                        $collect[$this->array_header[$key]] = $val;
                        if (is_null($newData['fio']) || $newData['fio']==''){
                            $upload_error = true;
                        }
                        break;
                    case $this->birthdate:
                        $date = intval($val);
                        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('d.m.Y');
                        $newData['birthdate'] = $date;
                        $collect[$this->array_header[$key]] = $date;
                        break;
                    case $this->inn:
                        $newData['inn'] = $val;
                        $collect[$this->array_header[$key]] = $val;
                        break;
                    case $this->ipKey:
                        $val = str_replace(' ', '', $val);
                        $newData['ip_number'] = $val;
                        $collect[$this->array_header[$key]] = $val;
                        break;
                    case $this->idKey:
                        $newData['id_number'] = $val;
                        $collect[$this->array_header[$key]] = $val;
                        if (is_null($newData['id_number']) || $newData['id_number']==''){
                            $upload_error = true;
                        }
                        break;
                    case $this->idRegion:
                        $newData['region_id'] = $this->get_region_id($val);


                        $collect[$this->array_header[$key]] = $val;
                        if ($newData['region_id'] == -1){
                            $upload_error = true;
                        }
                        break;
                    default:
                        $collect[$this->array_header[$key]] = $val;
                }
            }
            ksort($collect);
            $collect = new Collection($collect);
            $newData['line'] = $collect->toJson();
            $newData['header'] = false;
            $newData['upload_error'] = $upload_error;
            $data = $newData;
        }
        ++$this->rows;
        return new Reestr($data);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    private function isRow($key, $val, $string = null)
    {
        if ($string !== null && $val !== null) {
            if (mb_strtolower($val) == $string) {
                array_push($this->data, $val);
            }
        } elseif ($val === null) {
            return false;
        }
        return true;
    }

    private function get_region_id($reg_name){
        $fnd = 0;
        $reg_id = -1;
        foreach($this->regions as $reg){
            if ($reg['value'] == $reg_name){
                $fnd = 1;
                $reg_id = $reg['id'];
                break;
            }
        }
        if ($fnd == 0){
            foreach($this->stop_words as $word){
                $reg_name = str_replace(' '.$word, '', $reg_name);
                $reg_name = str_replace($word.' ', '', $reg_name);
                $reg_name = str_replace($word, '', $reg_name);
            }
            foreach($this->regions as $reg){
                if (mb_strpos(mb_strtolower($reg['value']), mb_strtolower($reg_name))!==false){
                    $fnd = 1;
                    $reg_id = $reg['id'];
                    break;
                }
            }

        }
        return $reg_id;
    }
}
