<?php

namespace App\Models\Gospochta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GosmailReport extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'active'];
}
