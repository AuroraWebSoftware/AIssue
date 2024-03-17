<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use Illuminate\Database\Query\Builder;

/**
 * issue owner model
 */
interface IssueOwnerModelContract extends ConnectiveContract
{
    /**
     * ConnectiveCollection<AIssue>
     */
    public function getOwningIssues(): ConnectiveCollection;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function scopeAllOwningIssues(Builder $query): ConnectiveCollection;
}
