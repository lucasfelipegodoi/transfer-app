<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    protected $table = 'wallet';

    protected $fillable = [
        'users_id', 
        'current_ballance', 
    ];


    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }
}
