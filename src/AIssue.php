<?php

namespace AuroraWebSoftware\AIssue;

class AIssue
{
    public function createIssue(): Models\AIssue
    {
    }

    public function canMakeTransition(Models\AIssue $issue, $status): bool
    {
        $permission = config('aissue')['issueTypes']['$issue->issueType'][$status]['permission'];
        if (config('aissue')['policyMethod']($permission)) {
            return true;
        }

        return false;
    }

    public function makeTransition(Models\AIssue $issue, $status): Models\AIssue
    {
        if ($this->canMakeTransition($issue, $status)) {
            $issue->status = $status;
            $issue->save();
        }

        return $issue;
    }
}
