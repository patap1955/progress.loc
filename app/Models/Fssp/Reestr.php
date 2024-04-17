<?php

namespace App\Models\Fssp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Reestr extends Model
{
    use HasFactory;

    protected $fillable = ['ip_number', 'line', 'id_number', 'birthdate', 'header', 'region_id', 'fio', 'upload_error', 'real_credit', 'credit', 'difference'];

    public static function jsonDecodeReestrsLine()
    {
        $reestrs = self::all();

        $newReestrs = [];
        foreach ($reestrs as $key => $val) {
            $newReestrs[$key] = json_decode($val->line);
        }

        return new Collection($newReestrs);
    }
}
