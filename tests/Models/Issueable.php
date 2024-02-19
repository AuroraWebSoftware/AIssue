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

    public static function getAIssueDefaultStatus(string $issueType): string
    {
        return 'todo';
    }

    public static function getAIssueModelType(): string
    {
        return 'AuroraWebSoftware\AIssue\Tests\Models\Issueable';
    }

    public function getAIssueModelId(): int
    {
        return $this->id;
    }
}
