<?php

namespace App\Providers;

use App\Models\UserModel;
use App\Services\AuthenticationService;
use App\Services\UserAccountServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // SERVICE PROVIDER - USED FOR REGISTERING A CLASSES THAT INSTANTIATES AN INTERFACE OR ABSTRACT CLASS
        $this->app->singleton(AuthenticationService::class, function ($app) {
            return new AuthenticationService([
                $app->make(UserAccountServices::class),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
