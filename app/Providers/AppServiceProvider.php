<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Plugins\Query;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $roles = Query::role();
        if ($roles) {
            foreach ($roles as $role) {
                Blade::if($role->field_primary, function () use ($role) {
                    return auth()->check() && auth()->user()->role == $role->field_primary;
                });
            }
        }

        Blade::if('level', function ($value) {
            return auth()->check() && auth()->user()->level >= $value;
        });

        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/vendor/livewire/livewire.js', $handle);
        });

        if(env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
