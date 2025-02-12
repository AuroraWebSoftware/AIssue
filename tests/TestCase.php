<?php

namespace AuroraWebSoftware\AIssue\Tests;

use AuroraWebSoftware\AIssue\AIssueServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'AuroraWebSoftware\\AIssue\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AIssueServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // config()->set('database.default', 'testing');
        config()->set('database.default', 'mysql');

        /*
        $migration = include __DIR__.'/../database/migrations/create_aissue_table.php.stub';
        $migration->up();
        */
    }
}
