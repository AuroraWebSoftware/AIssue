<?php

namespace AuroraWebSoftware\AIssue\Traits;

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;
use AuroraWebSoftware\AIssue\Exceptions\TransitionStatusNotFoundException;

trait AIssue {

    /**
     * @return array<string>
     */
    public function getTransitionableStatuses(): array {

    }

    /**
     * @param string $status
     * @throws TransitionStatusNotFoundException
     * @throws TransitionPermissionException
     * @return bool
     */
    public function makeTransition(string $status): {

    }

}
