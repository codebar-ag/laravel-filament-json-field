<?php

namespace CodebarAg\FilamentJsonField;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentJsonFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-filament-json-field')
            ->hasViews();
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Css::make('laravel-filament-json-field', __DIR__.'/../dist/laravel-filament-json-field.css'),
            Js::make('laravel-filament-json-field', __DIR__.'/../dist/laravel-filament-json-field.js'),
        ], 'laravel-filament-json-field');
    }
}
