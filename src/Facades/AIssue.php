<?php

namespace AuroraWebSoftware\AIssue\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AuroraWebSoftware\AIssue\AIssue
 *
 * @method static createIssue($data): \AuroraWebSoftware\AIssue\Models\AIssue
 * @method static canMakeTransition(\AuroraWebSoftware\AIssue\Models\AIssue $issue, $status): bool
 * @method static makeTransition(\AuroraWebSoftware\AIssue\Models\AIssue $issue, $status): \AuroraWebSoftware\AIssue\Models\AIssue
 * @method static getTransitionableStatuses(\AuroraWebSoftware\AIssue\Models\AIssue $issue)
 */
class AIssue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AuroraWebSoftware\AIssue\AIssue::class;
    }
}
