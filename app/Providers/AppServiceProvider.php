<?php

namespace App\Providers;

use App\Models\UsersType;
use App\Models\Wallet;
use App\Exceptions\Exception;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        app('validator')->extend('payer_validation', function ($attribute, $value) {
            try{
                return Wallet::find($value)->user->users_type_id == UsersType::ID_TYPE_COMUM;
             } catch(Exception $ex){
                return false;
            }
        });

        app('validator')->replacer('payer_validation', function ($message, $attribute, $rule, $parameters) {
            return 'Não é possível transferir de uma conta lojista';
        });
    }

}
