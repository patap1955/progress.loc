<?php

namespace App\Models\Gospochta;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;

    public function messages () {
        return $this->hasMany(Message::class);
    }

    public function users () {
        return $this->hasMany(User::class);
    }
}
