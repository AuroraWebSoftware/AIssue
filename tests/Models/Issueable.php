<?php

namespace AuroraWebSoftware\AIssue\Tests\Models;

use AuroraWebSoftware\AIssue\Contracts\AIssueModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueModelTrait;
use Illuminate\Database\Eloquent\Model;

class Issueable extends Model implements AIssueModelContract
{
    use AIssueModelTrait;

    protected $fillable = ['name'];

    /**
     * @return string
     */
    public static function getAIssueType(): string
    {
        return 'task';
    }

    /**
     * @return string
     */
    public static function getAIssueDefaultStatus(): string
    {
        return 'todo';
    }

    /**
     * @return string
     */
    public static function getAIssueModelType(): string
    {
        return 'AuroraWebSoftware\AIssue\Tests\Models\Issueable';
    }

    /**
     * @return string
     */
    public function getAIssueModelId(): string
    {
        return $this->id;
    }
}
