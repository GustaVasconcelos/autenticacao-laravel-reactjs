<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\BaseRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registra as implementações dos repositórios
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        // Registra o UserService
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
