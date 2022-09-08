<?php

namespace AuroraWebSoftware\AIssue;

class AIssue
{

    public static function createIssue($data): Models\AIssue
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
        $permission = config('aissue')['issueTypes']['$issue->issueType'][$status]['permission'];
        if (config('aissue')['policyMethod']($permission)) {
            return true;
        }

        return false;
    }

    /**
     * @param  Models\AIssue  $issue
     * @param $status
     * @return Models\AIssue
     */
    public function makeTransition(Models\AIssue $issue, $status): Models\AIssue
    {
        if ($this->canMakeTransition($issue, $status)) {
            $issue->status = $status;
            $issue->save();
        }

        return $issue;
    }

    /**
     * @param  Models\AIssue  $issue
     * @return array<string>
     */
    public function getTransitionableStatuses(Models\AIssue $issue): array
    {
        $statuses = [];
        foreach (config('aissue')['issueTypes'][$issue->issueType] as $index => $item) {
            if ($this->canMakeTransition($issue, $index)) {
                $statuses[] = $index;
            }
        }

        return $statuses;
    }
}
