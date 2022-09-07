<?php

namespace AuroraWebSoftware\AIssue;

class AIssue
{
    public function createIssue(): \AuroraWebSoftware\AIssue\Models\AIssue
    {



    }

    public function canMakeTransition(\AuroraWebSoftware\AIssue\Models\AIssue $issue, $status): bool
    {
        $permission = config('aissue')['issueTypes']['$issue->issueType'][$status]['permission'];
        if (config('aissue')['policyMethod']($permission)) {
            return true;
        }
        return false;
    }

    public function makeTransition(\AuroraWebSoftware\AIssue\Models\AIssue $issue, $status): \AuroraWebSoftware\AIssue\Models\AIssue
    {
        if ($this->canMakeTransition($issue, $status)) {
            $issue->status = $status;
            $issue->save();
        }
        return $issue;
    }

}
