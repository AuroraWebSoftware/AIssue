<?php

namespace AuroraWebSoftware\AIssue\Tests\Models;

use AuroraWebSoftware\AIssue\Contracts\AIssueModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 */
class Issueable extends Model implements AIssueModelContract
{
    use AIssueModelTrait;

    protected $fillable = ['name'];

    /**
     * @param string $issueType
     * @return string
     */
    public static function getAIssueDefaultStatus(string $issueType): string
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
     * @return int
     */
    public function getAIssueModelId(): int
    {
        return $this->id;
    }
}
