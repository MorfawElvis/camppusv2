<?php

namespace App\Providers;

use App\Services\Attendance\SkySmsService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the SmsService to the service container
        $this->app->bind(SkySmsService::class, function ($app) {
            return new SkySmsService(); // Pass necessary dependencies if any
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
    }
}
