<?php

namespace App\Providers;

use App\Repositories\Eloquent\Category\CategoryRepositoryInterface;
use App\Repositories\Eloquent\User\UserRepositoryInterface;
use App\Services\Category\CategoryService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryService::class);
    }
}
