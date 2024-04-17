<?php

namespace App\Http\Controllers\Fssp;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Fssp;
use App\Models\Fssp\LogSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FsspController extends Controller
{
    public function searchByIp (Request $request, Fssp $fssp) {
        $fssp->search_type = 1;

        $logSearch = ['status' => 'Начало поиска', 'time' => now()];
//        LogSearch::create($logSearch);

        $data = json_decode($fssp->test(['ip_number' => $request->value]));

        if ($data->error == false) {
            $logSearch = ['status' => 'Конец поиска', 'code' => 200, 'message' => 'Запрос прошел успешно', 'time' => now()];
//            LogSearch::create($logSearch);
            $data = $this->parseArrayData($data);
        } else {
            $logSearch = ['status' => 'Конец поиска', 'code' => $data->message, 'message' => $data->info, 'time' => now()];
//            LogSearch::create($logSearch);
        }
        return $data;
    }

    public function searchByInn (Request $request, Fssp $fssp) {
        $fssp->search_type = 3;
        $data = json_decode($fssp->test(['inn_number' => $request->value]));
        $data = $this->parseArrayData($data);

        return $data;
    }

    public function searchById (Request $request, Fssp $fssp) {
        $fssp->search_type = 5;
        $data = json_decode($fssp->test(['id_number' => $request->id_number, 'id_issuer' => $request->id_issuer, 'region_id' => $request->region, 'id_type' => $request->id_type]));
        $data = $this->parseArrayData($data);

        return $data;
    }

    public function searchByFl (Request $request, Fssp $fssp) {
        $fssp->search_type = 2;
        $data = json_decode(
            $fssp->test(
                [
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'patronymic' => $request->patronymic,
                    'region_id' => $request->region,
                    'date' => $request->date
                ])
        );
        $data = $this->parseArrayData($data);

        return $data;
    }

    public function searchByUl (Request $request, Fssp $fssp) {
        $fssp->search_type = 4;
        $data = json_decode(
            $fssp->test(
                [
                    'name' => $request->name,
                    'region_id' => $request->region,
                    'address' => $request->address
                ])
        );
        $data = $this->parseArrayData($data);

        return $data;
    }

    private function parseArrayData($data) {
        $new_data = [];
        $array_data = [];
        $count = 0;
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
}
