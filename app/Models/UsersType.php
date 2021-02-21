<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UsersType extends Model 
{

    public const ID_TYPE_COMUM = 1;
    public const ID_TYPE_LOJISTA = 2;

    protected $table = 'users_type';

    protected $fillable = [
        'type', 
    ];
   
    public static function getTypes(){
        return [UsersType::ID_TYPE_COMUM, UsersType::ID_TYPE_LOJISTA];
    }

}
