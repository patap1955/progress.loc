<?php

namespace App\Models\Fssp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriSearchReestrId extends Model
{
    use HasFactory;

    protected $fillable = ['id_number', 'fio', 'status', 'credit', 'line', 'header'];
}
