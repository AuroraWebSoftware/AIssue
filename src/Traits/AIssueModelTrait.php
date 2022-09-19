<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\AIssue\Exceptions\IssueTypeNotFoundException;
use AuroraWebSoftware\AIssue\Facades\AIssue;
use Illuminate\Support\Carbon;

trait AIssueModelTrait
{
    /**
     * @param int $assigneeId
     * @param int $createrId
     * @param string $issueType
     * @param string $summary
     * @param string $description
     * @param int $priority
     * @param Carbon $duedate
     * @return \AuroraWebSoftware\AIssue\Models\AIssue
     * @throws IssueTypeNotFoundException
     */
    public function createIssue(
        int    $assigneeId,
        int    $createrId,
        string $issueType,
        string $summary,
        string $description,
        int    $priority,
        Carbon $duedate,
    ): \AuroraWebSoftware\AIssue\Models\AIssue
    {
        $configIssueTypes = config('aissue')['issueTypes'];
        if (! array_key_exists($issueType, $configIssueTypes)) {
            throw new IssueTypeNotFoundException("$issueType Not Found, Please check Your Config File.");
        }

        // todo status yetki kontrolü

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
