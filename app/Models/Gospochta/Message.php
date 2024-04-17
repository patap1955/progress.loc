<?php

namespace App\Models\Gospochta;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function files () {
        return $this->hasMany(File::class);
    }

    public function sender () {
        return $this->belongsTo(Sender::class);
    }
    public function user () {
        return $this->belongsTo(User::class);
    }
}
