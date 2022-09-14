<?php

namespace AuroraWebSoftware\AIssue\Contracts;

/**
 * AIssueModelContract
 */
interface AIssueModelContract
{
    /**
     * @param  string  $issueType
     * @return string
     */
    public static function getAIssueDefaultStatus(string $issueType): string;

    /**
     * @return string
     */
    public static function getAIssueModelType(): string;

    /**
     * @return int
     */
    public function getAIssueModelId(): int;
}
