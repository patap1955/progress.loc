<?php

namespace App\Models\Gospochta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function message () {
        return $this->belongsTo(Message::class);
    }
}
