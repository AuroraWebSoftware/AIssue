<?php

namespace AuroraWebSoftware\AIssue\Contracts;

/**
 * AIssueModelContract
 */
interface AIssueModelContract
{
    /**
     * @return string
     */
    public static function getAIssueType(): string;

    /**
     * @return string
     */
    public static function getAIssueDefaultStatus(): string;

    /**
     * @return string
     */
    public static function getAIssueModelType(): string;

    /**
     * @return string
     */
    public function getAIssueModelId(): string;
}
