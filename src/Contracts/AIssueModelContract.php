<?php

namespace AuroraWebSoftware\AIssue\Contracts;

/**
 * AIssueModelContract
 */
interface AIssueModelContract
{
    public static function getAIssueDefaultStatus(string $issueType): string;

    public static function getAIssueModelType(): string;

    public function getAIssueModelId(): int;
}
