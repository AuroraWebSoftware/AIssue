<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\AIssue\Models\AIssue;
use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use Illuminate\Database\Query\Builder;

/**
 * issue owner model
 */
interface IssueOwnerModelContract extends ConnectiveContract
{
    public function ownIssue(AIssue $issue): void;

    public function disownIssue(AIssue $issue): void;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function getOwningIssues(): ?ConnectiveCollection;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function scopeAllOwningIssues(Builder $query): ?ConnectiveCollection;




}
