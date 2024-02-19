<?php

namespace AuroraWebSoftware\AIssue;

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;

class AIssue
{
    public function createIssue(array $data): Models\AIssue
    {
        return Models\AIssue::create($data);
    }

    public function canMakeTransition(Models\AIssue $issue, string $status): bool
    {
        $permission = config('aissue')['issueTypes'][$issue->getIssueType()][$status]['permission'];
        if (config('aissue')['policyMethod']($permission)) {
            return true;
        }

        return false;
    }

    /**
     * @throws TransitionPermissionException
     */
    public function makeTransition(Models\AIssue $issue, string $status): Models\AIssue
    {
        if ($this->canMakeTransition($issue, $status)) {
            $issue->status = $status;
            $issue->save();

            return $issue;
        }
        throw new TransitionPermissionException();
    }

    /**
     * @return array<string>
     */
    public function getTransitionableStatuses(Models\AIssue $issue): array
    {
        $statuses = [];
        foreach (config('aissue')['issueTypes'][$issue->getIssueType()] as $index => $item) {
            if ($this->canMakeTransition($issue, $index)) {
                $statuses[] = $index;
            }
        }

        return $statuses;
    }
}
