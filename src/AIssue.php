<?php

namespace AuroraWebSoftware\AIssue;

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;

class AIssue
{
    /**
     * @param $data
     * @return Models\AIssue
     */
    public function createIssue($data): Models\AIssue
    {
        return Models\AIssue::create($data);
    }

    /**
     * @param  Models\AIssue  $issue
     * @param $status
     * @return bool
     */
    public function canMakeTransition(Models\AIssue $issue, $status): bool
    {
        $permission = config('aissue')['issueTypes']['task'][$status]['permission'];
        if (config('aissue')['policyMethod']($permission)) {
            return true;
        }

        return false;
    }

    /**
     * @param  Models\AIssue  $issue
     * @param $status
     * @return Models\AIssue
     *
     * @throws TransitionPermissionException
     */
    public function makeTransition(Models\AIssue $issue, $status): Models\AIssue
    {
        if ($this->canMakeTransition($issue, $status)) {
            $issue->status = $status;
            $issue->save();
        }

        throw new TransitionPermissionException();
    }

    /**
     * @param  Models\AIssue  $issue
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
