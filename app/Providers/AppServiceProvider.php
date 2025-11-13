<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        // Enregistrement automatique du composant Livewire si besoin
        if (class_exists(Livewire::class)) {
            Livewire::component('counter', \App\Http\Livewire\Counter::class);
        }
    }
}
