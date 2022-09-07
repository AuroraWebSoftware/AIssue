<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;
use AuroraWebSoftware\AIssue\Exceptions\TransitionStatusNotFoundException;

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
