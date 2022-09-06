<?php

namespace AuroraWebSoftware\AIssue\Contracts;

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;
use AuroraWebSoftware\AIssue\Exceptions\TransitionStatusNotFoundException;

/**
 * AIssueContract
 */
interface AIssueContract
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

    /**
     * @return array<string>
     */
    public function getTransitionableStatuses(): array;

    /**
     * @param  string  $status
     * @return bool
     *
     * @throws TransitionStatusNotFoundException
     * @throws TransitionPermissionException
     */
    public function makeTransition(string $status): bool;
}
