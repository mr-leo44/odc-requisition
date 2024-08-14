<?php

namespace App\Providers;

use App\Enums\RoleEnum;
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
            if ($role === 'user' && Session::get('authUser')->compte->role->value === RoleEnum::USER->value) {
                $isAdmin = true;
            } elseif ($role === 'admin' && Session::get('authUser')->compte->role->value === RoleEnum::ADMIN->value) {
                $isAdmin = true;
            } elseif($role === 'livraison' && Session::get('authUser')->compte->role->value === RoleEnum::LIVRAISON->value){
                $isAdmin = true;
            } elseif($role === 'not-admin' && Session::get('authUser')->compte->role->value !== RoleEnum::ADMIN->value){
                $isAdmin = true;
            } else{
                $isAdmin = false;
            }

            return $isAdmin;
        });
    }
}
