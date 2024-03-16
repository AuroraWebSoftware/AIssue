<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;

/**
 * IssueActorModelContract
 */
interface IssueActorModelContract extends ConnectiveContract
{
    public function getActorName(): string;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function getActingModels(string $connectionType): ConnectiveCollection;
}
