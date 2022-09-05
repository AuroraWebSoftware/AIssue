<?php

namespace AuroraWebSoftware\AIssue;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AuroraWebSoftware\AIssue\Commands\AIssueCommand;

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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_aissue_table')
            ->hasCommand(AIssueCommand::class);
    }
}
