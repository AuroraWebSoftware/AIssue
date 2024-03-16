<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;

interface IssueOwnerModelContract extends ConnectiveContract
{
    /**
     * ConnectiveCollection<AIssue>
     */
    public function getOwnedIssues(): ConnectiveCollection;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function scopeAllOwnedIssues($query): ConnectiveCollection;
}
