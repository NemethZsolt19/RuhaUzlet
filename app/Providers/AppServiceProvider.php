<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
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
        Gate::define( "costumer", function( $user ) {

            return $user->status == 1;
        });

        Gate::define( "worker", function( $user ) {

            return $user->status == 2;
        });
    }
}
