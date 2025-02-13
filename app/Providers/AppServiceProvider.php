<?php

namespace App\Providers;

use App\Classes\Interfaces\VerseLinkGenerator;
use App\Classes\Verse\BibleGatewayGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VerseLinkGenerator::class, BibleGatewayGenerator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
