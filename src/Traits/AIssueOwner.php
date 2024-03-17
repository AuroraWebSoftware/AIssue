<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\AIssue\Contracts\IssueOwnerModelContract;
use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;

trait AIssueOwner
{
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
}
