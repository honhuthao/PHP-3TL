<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{
    use HasFactory;

    public $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}