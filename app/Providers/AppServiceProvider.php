<?php

namespace App\Providers;

use App\Services\GuardianService;
use App\Services\NewsAPIService;
use App\Services\NYTimesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
	    $this->app->tag([GuardianService::class, NewsAPIService::class, NYTimesService::class], 'news_updaters');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
