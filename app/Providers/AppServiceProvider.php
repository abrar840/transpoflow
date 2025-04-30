<?php

namespace App\Providers;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            if (Auth::guard('end_user')->check()) {
                return route('user-home', ['company' => Auth::guard('end_user')->user()->company->name]);
            }
            // Default for admin or others
            return route('dashboard');
        });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
