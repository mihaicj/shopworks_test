<?php

namespace App\Providers;

use App\Services\AloneTimeCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AloneTimeCalculator::class, function () {
            return new AloneTimeCalculator();
        });
    }
}
