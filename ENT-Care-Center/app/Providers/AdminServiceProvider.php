<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\admin;
use Illuminate\Support\Facades\Auth;






class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot(): void
    {


        // Blade::if('hasRole', function ($expression) {
        //     if (Auth::user()) {
        //         if (Auth::user()->$this->hasRole($expression)) {
        //             return true;
        //         }
        //     }
        //     return false;
        // });
    }
}
