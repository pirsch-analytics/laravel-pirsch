<?php

namespace Pirsch;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PirschServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-pirsch')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->bind(
            \Pirsch\Facades\Pirsch::class,
            \Pirsch\Pirsch::class
        );
    }
}
