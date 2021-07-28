<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repository\Contracts\DocumentSendRepositoryInterface',
            'App\Repository\DocumentSendRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\DisplayInterface',
            'App\Services\DisplayHistoric'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
