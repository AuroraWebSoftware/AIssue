<?php

namespace AuroraWebSoftware\AIssue\Tests\Models;

use AuroraWebSoftware\AIssue\Contracts\IssueOwnerModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueOwner;
use AuroraWebSoftware\Connective\Traits\Connective;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 *
 * @method static ExampleIssueOwner create(array $attributes = [])
 */
class ExampleIssueOwner extends Model implements IssueOwnerModelContract
{
    use AIssueOwner;
    use Connective;

    protected $guarded = [];

    public static function supportedConnectionTypes(): array
    {
        return [];
    }
}
