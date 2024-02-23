<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;

/**
 * IssueActorModelContract
 */
interface IssueActorModelContract
{
    public function getActorName(): string;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function getActingModels(string $connectionType): ConnectiveCollection;
}
