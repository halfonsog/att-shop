<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Path to redirect after authentication.
     * Dynamically handled in AuthController
     */
    public const HOME = '/'; // Fallback for unauthenticated
    
    /**
     * The controller namespace for the application.
     */
    protected $namespace = 'App\\Http\\Controllers';
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthService::class, function () {
            return new AuthService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
  
}
