<?php

namespace AuroraWebSoftware\AIssue\Contracts;

/**
 * IssueActorModelContract
 */
interface IssueActorModelContract
{
    /**
     * returns the available actor connection types for an issue model actor
     * example: issue_responsible, issue_participant, issue_observer
     * issue connections : responsible_model, participant_model, issue_model
     *
     * @return array<string>
     */
    public static function getActorConnectiveConnectionTypes(): array;

    public function getActorName(): string;

    /**
     * ConnectiveCollection<AIssue>
     */
    public function getActingModels(string $connectionType): ConnectiveCollection;
}
