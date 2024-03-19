<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * issue actor can be one of the following:
 * IssueReporter
 * IssueResponsible
 * IssueObserver
 * IssueActorModelContract
 */
interface IssueActorModelContract extends ConnectiveContract
{
    public function getIssueActorName(): string;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function getActingIssues(string $connectionType): ConnectiveCollection;

    /**
     * @return array<string, string>
     *                               ['channel' => 'email', 'email' => 'example@ex.com']
     */
    public function getIssueReminderConfig(): array;

    /**
     * @return Collection<int, Model&IssueActorModelContract>
     */
    public static function searchIssueActor(string $searchTerm): Collection;
}
