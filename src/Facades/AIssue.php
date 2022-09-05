<?php

namespace AuroraWebSoftware\AIssue\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AuroraWebSoftware\AIssue\AIssue
 */
class AIssue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AuroraWebSoftware\AIssue\AIssue::class;
    }
}
