<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryEloquent;
use App\Repositories\Favorite\FavoriteRepository;
use App\Repositories\Favorite\FavoriteRepositoryEloquent;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Services\Comment\CommentService;
use App\Services\Comment\CommentServiceImp;
use App\Services\Favorite\FavoriteService;
use App\Services\Favorite\FavoriteServiceImp;
use App\Services\Message\MessageService;
use App\Services\Message\MessageServiceImp;
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
        $this->app->bind(CommentService::class, CommentServiceImp::class);
        $this->app->bind(MessageService::class, MessageServiceImp::class);


        // repository service
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(FavoriteRepository::class, FavoriteRepositoryEloquent::class);
        $this->app->bind(CommentRepository::class, CommentRepositoryEloquent::class);
        $this->app->bind(MessageRepository::class, MessageRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
