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
    }

}
