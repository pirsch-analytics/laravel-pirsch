<?php

namespace Pirsch\Facades;

use Illuminate\Support\Facades\Facade;

class Pirsch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-pirsch';
    }
}
