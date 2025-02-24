<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
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
        // load custom stylesheet
        FilamentAsset::register([
            Css::make('app', __DIR__ . '/../../resources/css/filament.css'),
        ]);

        // load custom javascript
        FilamentAsset::register([
            Js::make('app', __DIR__ . '/../../resources/js/filament.js'),
        ]);

    }
}
