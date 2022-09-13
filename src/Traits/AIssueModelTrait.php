<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\AIssue\Facades\AIssue;
use Illuminate\Support\Carbon;

trait AIssueModelTrait
{
    /**
     * @param  int  $assigneeId
     * @param  int  $createrId
     * @param  string  $summary
     * @param  string  $description
     * @param  int  $priority
     * @param  Carbon  $duedate
     * @return \AuroraWebSoftware\AIssue\Models\AIssue
     */
    public function createIssue(
        int $assigneeId,
        int $createrId,
        string $summary,
        string $description,
        int $priority,
        Carbon $duedate,
    ): \AuroraWebSoftware\AIssue\Models\AIssue {
        $data = [
            'code' => 'test',
            'model_type' => static::getAIssueModelType(),
            'model_id' => $this->id,
            'assignee_id' => $assigneeId,
            'creater_id' => $createrId,
            'issue_type' => static::getAIssueType(),
            'summary' => $summary,
            'description' => $description,
            'priority' => $priority,
            'status' => static::getAIssueDefaultStatus(),
            'duedate' => $duedate,
        ];

        return AIssue::createIssue($data);
    }

    /**
     * @param $status
     * @return bool
     */
    public function canMakeTransition($status): bool
    {
        return AIssue::canMakeTransition($this, $status);
    }

    /**
     * @param $status
     * @return \AuroraWebSoftware\AIssue\Models\AIssue
     */
    public function makeTransition($status): \AuroraWebSoftware\AIssue\Models\AIssue
    {
        return AIssue::makeTransition($this, $status);
    }

    /**
     * @param  \AuroraWebSoftware\AIssue\Models\AIssue  $issue
     * @return array
     */
    public function getTransitionableStatuses(\AuroraWebSoftware\AIssue\Models\AIssue $issue): array
    {
        return AIssue::getTransitionableStatuses($this);
    }
}
