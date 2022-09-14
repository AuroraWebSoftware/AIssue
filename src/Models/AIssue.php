<?php

namespace AuroraWebSoftware\AIssue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIssue extends Model
{
    use HasFactory;

    public $guarded = [];
    public string $status;
    public string $issue_type;

    protected $table = 'aissue_issues';

    /**
     * @return string
     */
    public function getIssueType(): string
    {
        return $this->issue_type;
    }

    /**
     * @param $status
     * @return bool
     */
    public function canMakeTransition($status): bool
    {
        return \AuroraWebSoftware\AIssue\Facades\AIssue::canMakeTransition($this, $status);
    }

    /**
     * @param $status
     * @return AIssue
     */
    public function makeTransition($status): AIssue
    {
        return \AuroraWebSoftware\AIssue\Facades\AIssue::makeTransition($this, $status);
    }

    /**
     * @param AIssue $issue
     * @return array
     */
    public function getTransitionableStatuses(AIssue $issue): array
    {
        return \AuroraWebSoftware\AIssue\Facades\AIssue::getTransitionableStatuses($this);
    }

}
