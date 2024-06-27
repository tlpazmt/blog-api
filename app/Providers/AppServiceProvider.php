<?php

namespace App\Providers;

use App\Contracts\DummyJsonInterface;
use App\Contracts\PostServiceInterface;
use App\Services\DummyJsonService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(DummyJsonInterface::class, DummyJsonService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
