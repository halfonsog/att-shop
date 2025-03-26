<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
/**
     * The path to the "home" route for your application.
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     */
    protected $namespace = 'App\\Http\\Controllers';
    
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
    }
}
