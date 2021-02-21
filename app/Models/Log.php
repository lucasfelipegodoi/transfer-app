<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model 
{
    use SoftDeletes;
    
    protected $table = 'logs';

    protected $fillable = [
        'instance',
        'level',
        'message',
        'method',
        'context'
    ];
}