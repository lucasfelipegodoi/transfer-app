<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'wallet_id', 
        'transaction_type_id', 
        'value',
        'wallet_id_payer',
        'wallet_id_payee'
    ];

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function transactionType(){
        return $this->belongsTo(TransactionTypes::class, 'transaction_type_id');
    }
}
