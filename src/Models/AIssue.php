<?php

namespace AuroraWebSoftware\AIssue\Models;

use AuroraWebSoftware\ArFlow\Contacts\StateableModelContract;
use AuroraWebSoftware\ArFlow\Traits\HasState;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use AuroraWebSoftware\Connective\Traits\Connective;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $status
 * @property-read string $issue_type
 */
class AIssue extends Model implements ConnectiveContract, StateableModelContract
{
    use Connective;
    use HasState {
        HasState::getId insteadof Connective;
    }

    public $guarded = [];

    protected $table = 'aissue_issues';

    public static function supportedConnectionTypes(): array
    {
        return ['responsible', 'participant', 'observer'];
    }

    public static function supportedWorkflows(): array
    {
        return ['simple'];
    }
}
