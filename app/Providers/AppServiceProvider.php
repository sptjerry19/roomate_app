<?php

namespace App\Providers;

use App\Repositories\Favorite\FavoriteRepository;
use App\Repositories\Favorite\FavoriteRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Services\Favorite\FavoriteService;
use App\Services\Favorite\FavoriteServiceImp;
use App\Services\User\UserService;
use App\Services\User\UserServiceImp;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // service provider
        $this->app->bind(UserService::class, UserServiceImp::class);
        $this->app->bind(FavoriteService::class, FavoriteServiceImp::class);


        // repository service
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(FavoriteRepository::class, FavoriteRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}