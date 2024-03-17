<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;

trait AIssueActor
{
    /**
     * ConnectiveCollection<AIssue>
     */
    public function getActingIssues(string $connectionType): ConnectiveCollection
    {
        return $this->inverseConnectives($connectionType);
    }
}
