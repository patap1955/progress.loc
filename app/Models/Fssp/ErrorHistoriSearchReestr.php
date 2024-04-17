<?php

namespace App\Models\Fssp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorHistoriSearchReestr extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'message', 'reestr_id', 'time'];
}
