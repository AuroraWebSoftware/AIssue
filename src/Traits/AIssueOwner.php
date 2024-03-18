<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\AIssue\Contracts\IssueActorModelContract;
use AuroraWebSoftware\AIssue\Contracts\IssueOwnerModelContract;
use AuroraWebSoftware\AIssue\Models\AIssue;
use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Exceptions\ConnectionTypeException;
use AuroraWebSoftware\Connective\Exceptions\ConnectionTypeNotSupportedException;
use Illuminate\Database\Query\Builder;

trait AIssueOwner
{
    /**
     * @throws ConnectionTypeNotSupportedException
     * @throws ConnectionTypeException
     */
    public function ownIssue(AIssue $issue): void
    {
        $issue->connectTo($this, 'issue_owner_model');
    }

    public function disownIssue(AIssue $issue): void
    {
        // todo
        foreach ($this->getOwningIssues() ?? [] as $issueItem) {
            if ($issue->getId() === $issueItem->getId()) {
                $issue->connections('issue_owner_model')->delete();
                break;
            }
        }
    }


    /**
     * ConnectiveCollection<AIssue>
     */
    public function getOwningIssues(): ConnectiveCollection
    {
        /**
         * @var IssueOwnerModelContract $this
         */

        return $this->inverseConnectives('issue_owner_model');
    }

    public function scopeAllOwningIssues(Builder $query): ?ConnectiveCollection
    {
        // todo will be implemented
        return ConnectiveCollection::make();
    }
}
