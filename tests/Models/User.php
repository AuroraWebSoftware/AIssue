<?php

namespace AuroraWebSoftware\AIssue\Tests\Models;

use AuroraWebSoftware\AIssue\Contracts\IssueActorModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueActor;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use AuroraWebSoftware\Connective\Traits\Connective;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
class User extends Model implements ConnectiveContract, IssueActorModelContract
{
    use AIssueActor;
    use Connective;

    protected $guarded = [];

    public function getActorName(): string
    {
        return $this->name;
    }

    public static function supportedConnectionTypes(): array
    {
        return [];
    }
}
