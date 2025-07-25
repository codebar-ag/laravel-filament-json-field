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

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Js::make('laravel-filament-json-field', __DIR__.'/../dist/laravel-filament-json-field.js'),
            Css::make('laravel-filament-json-field', __DIR__.'/../dist/laravel-filament-json-field.css'),
        ], 'laravel-filament-json-field');
    }
}
