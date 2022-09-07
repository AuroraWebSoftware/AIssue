<?php

namespace AuroraWebSoftware\AIssue\Models;

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;
use AuroraWebSoftware\AIssue\Exceptions\TransitionStatusNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIssue extends Model
{
    use HasFactory;

    public $guarded = [];

    public string $issueType;

    public string $status;

    /**
     * @return array<string>
     */
    public function getTransitionableStatuses(): array
    {
        // config('aissue')
    }

    /**
     * @param  string  $status
     * @return bool
     *
     * @throws TransitionStatusNotFoundException
     * @throws TransitionPermissionException
     */
    public function makeTransition(string $status): bool
    {
        // statusü değiştircek
    }
}
