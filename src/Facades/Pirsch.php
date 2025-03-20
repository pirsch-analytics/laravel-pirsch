<?php

namespace Pirsch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void track(?string $name = null, ?array $meta = null)
 *
 * @see \Pirsch\Pirsch
 */
class Pirsch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pirsch\Facades\Pirsch::class;
    }
}
