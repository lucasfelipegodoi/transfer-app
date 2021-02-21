<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TransactionTypes extends Model 
{

    public const DEPOSIT = 1;
    public const TRANSFER = 2;

    protected $table = 'transaction_types';

    protected $fillable = [
        'type', 
    ];
   
    public static function getTypes(){
        return [TransactionTypes::DEPOSIT, TransactionTypes::TRANSFER];
    }

}
