<?php

namespace AuroraWebSoftware\AIssue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $status
 * @property-read string $issue_type
 */
class AIssue extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $table = 'aissue_issues';

    /**
     * @return string
     */
    public function getIssueType(): string
    {
        return $this->issue_type;
    }

    /**
     * @param  string  $status
     * @return bool
     */
    public function canMakeTransition(string $status): bool
    {
        return \AuroraWebSoftware\AIssue\Facades\AIssue::canMakeTransition($this, $status);
    }

    /**
     * @param  string  $status
     * @return AIssue
     */
    public function makeTransition(string $status): AIssue
    {
        return \AuroraWebSoftware\AIssue\Facades\AIssue::makeTransition($this, $status);
    }

    /**
     * @param  AIssue  $issue
     * @return array
     */
    public function getTransitionableStatuses(AIssue $issue): array
    {
        return \AuroraWebSoftware\AIssue\Facades\AIssue::getTransitionableStatuses($this);
    }
}
