<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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
        Schema::defaultStringLength(191);
        Blade::if('profile', function (string $role) {
            if ($role === 'admin' && Session::get('authUser')->compte->is_admin === 1) {
                $isAdmin = true;
            } elseif ($role === 'user' && Session::get('authUser')->compte->is_admin === 0) {
                $isAdmin = true;
            } else {
                $isAdmin = false;
            }

            return $isAdmin;
        });
    }
}
