<?php

namespace Pirsch\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Pirsch\PirschServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            PirschServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
