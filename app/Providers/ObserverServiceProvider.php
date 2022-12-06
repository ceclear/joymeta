<?php

namespace App\Providers;

use Core\Http\Repositories\Eloquent\User\User;
use Core\Http\Repositories\Observers\UserObserver;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //注册模型观察者类
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
