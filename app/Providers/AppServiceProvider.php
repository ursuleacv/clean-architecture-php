<?php

namespace App\Providers;

use App\DataAccess\Database\Gateway;
use CleanArch\Application\DataAccess\Database\GatewayInterface;
use CleanArch\Application\Repositories\UserRepository;
use CleanArch\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GatewayInterface::class, function ($app) {
            return new Gateway($app->make(Connection::class));
        });

        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository($app->make(GatewayInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
