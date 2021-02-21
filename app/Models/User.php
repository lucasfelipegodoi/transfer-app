<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

/**
 * @OA\Schema(
 *     description="Model User",
 *     type="object",
 * )
 */

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    protected $table = 'users';

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'document',
        'users_type_id'
    ];


    public function userType()
    {
        return $this->belongsTo(UsersType::class, 'users_type_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'users_id');
    }
}
