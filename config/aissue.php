<?php

// config for AuroraWebSoftware/AIssue


return [
    'policyMethod' => fn($permission): bool => true,
    'issueTypes' => [
        'task' => [
            'statuses' =>
                [
                    'todo' => ['sort' => 1, 'permission' => 'todo_perm'],
                    'in_progress' => ['sort' => 2, 'permission' => 'in_progress_perm'],
                    'done' => ['sort' => 3, 'permission' => 'done_perm'],
                ]
        ],
    ],
];
