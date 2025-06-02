<?php

namespace App\Providers;

use App\Contracts\OwnerRepositoryContract;
use App\Contracts\PropertyRepositoryContract;
use App\Repositories\OwnerRepository;
use App\Repositories\PropertyRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
        OwnerRepositoryContract::class,
        OwnerRepository::class
        );

        $this->app->bind(
        PropertyRepositoryContract::class,
        PropertyRepository::class
        );
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
