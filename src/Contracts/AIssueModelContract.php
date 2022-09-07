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
    public function getAIssueModelType(): string;

    /**
     * @return string
     */
    public function getAIssueModelId(): string;

    /**
     * @return string
     */
    public function getAIssueType(): string;
}
