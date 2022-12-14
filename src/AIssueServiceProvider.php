<?php

namespace AuroraWebSoftware\AIssue;

use AuroraWebSoftware\AIssue\Commands\AIssueCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AIssueServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('aissue')
            ->hasConfigFile();
        // ->hasViews()
        // ->hasMigration('create_aissue_table')
        // ->hasCommand(AIssueCommand::class);
    }

    public function boot(): void
    {
        parent::boot();
        // load packages migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../config' => config_path(),
        ], 'aissue-config');
    }
}
