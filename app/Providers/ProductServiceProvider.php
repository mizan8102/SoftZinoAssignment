<?php

namespace App\Providers;

use App\Repositories\Eloquent\Product\ProductRepositoryInterface;
use App\Services\Product\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductService::class);
    }
}
