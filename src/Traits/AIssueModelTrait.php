<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\AIssue\Facades\AIssue;
use Illuminate\Support\Carbon;

trait AIssueModelTrait
{
    /**
     * @param  int  $assigneeId
     * @param  int  $createrId
     * @param  string  $issueType
     * @param  string  $summary
     * @param  string  $description
     * @param  int  $priority
     * @param  Carbon  $duedate
     * @return \AuroraWebSoftware\AIssue\Models\AIssue
     */
    public function createIssue(
        int $assigneeId,
        int $createrId,
        string $issueType,
        string $summary,
        string $description,
        int $priority,
        Carbon $duedate,
    ): \AuroraWebSoftware\AIssue\Models\AIssue {
        $data = [
            'model_type' => static::getAIssueModelType(),
            'model_id' => $this->getAIssueModelId(),
            'assignee_id' => $assigneeId,
            'creater_id' => $createrId,
            'issue_type' => $issueType,
            'summary' => $summary,
            'description' => $description,
            'priority' => $priority,
            'status' => static::getAIssueDefaultStatus($issueType),
            'duedate' => $duedate,
        ];

        return AIssue::createIssue($data);
    }
}
