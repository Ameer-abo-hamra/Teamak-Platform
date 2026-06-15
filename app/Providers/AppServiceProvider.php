<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;

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
        Authenticate::redirectUsing(function ($request) {

            if ($request->routeIs('company.*')) {
                return route('company.login');
            }

            if ($request->routeIs('admin.*')) {
                return route('admin.login');
            }

            if ($request->routeIs('employee.*')) {
                return route('employee.login');
            }

            return route('company.login');
        });
    }
}
