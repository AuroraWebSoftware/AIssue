<?php

use AuroraWebSoftware\AIssue\Models\AIssue;
use AuroraWebSoftware\AIssue\Tests\Models\User;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {

    Artisan::call('migrate:fresh');

    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    $classArflow = require __DIR__.'/../../vendor/aurorawebsoftware/arflow/database/migrations/create_arflow_history_table.php';
    (new $classArflow)->up();

    $classConnective = require __DIR__.'/../../vendor/aurorawebsoftware/connective/database/migrations/2023_10_11_192125_create_connectives_table.php';
    (new $classConnective)->up();

    $classACalendar = require __DIR__.'/../../vendor/aurorawebsoftware/acalendar/database/migrations/create_acalendar_events_table.php';
    (new $classACalendar)->up();

    Config::set('arflow',
        [
            'workflows' => [
                'simple' => [
                    'states' => ['state1', 'state2', 'state3'],
                    'initial_state' => 'state1',
                    'transitions' => [
                        'transition_name' => [
                            'from' => ['state1'],
                            'to' => 'state2',
                            'guards' => [],
                            'actions' => [],
                            'success_metadata' => ['key' => 'value'],
                            'success_jobs' => [],
                        ],
                    ],
                ],
            ],
        ]);

    Config::set('connective',
        [
            'connection_types' => ['issue_owner_model', 'issue_reporter', 'issue_responsible', 'issue_observer'],
        ],
    );

});

it('can create an issue with simple workflow with a reporter, responsible user and 2 observers and due date ', function () {

    /**
     * @var User&ConnectiveContract $user1
     */
    $user1 = User::create(['name' => 'user 1']);
    $user2 = User::create(['name' => 'user 2']);
    $user3 = User::create(['name' => 'user 3']);
    $user4 = User::create(['name' => 'user 4']);

    $data = ['summary' => 'summary', 'description' => 'descr'];

    /**
     * @var AIssue $issue
     */
    $issue = AIssue::create($data);
    $issue->applyWorkflow('simple');

    $issue->setReporter($user1);
    $issue->setResponsible($user2);
    $issue->addObserver($user3);
    $issue->addObserver($user4);

    $issue->setDueDate(Carbon::today());

    expect($issue->currentState())->toBe('state1')
        ->and($user1->getActingIssues('issue_reporter'))
        ->toHaveCount(1)
        ->and($user2->getActingIssues('issue_responsible'))
        ->toHaveCount(1)
        ->and($user3->getActingIssues('issue_observer'))
        ->toHaveCount(1)
        ->and($user4->getActingIssues('issue_observer'))
        ->toHaveCount(1)
        ->and($issue->getDueDate())
        ->toBeInstanceOf(Carbon::class)
        ->and($issue->getDueDate()?->format('Y-m-d'))
        ->toEqual(Carbon::today()->format('Y-m-d'))
        ->and($issue->getReporter()?->getId())
        ->toBe($user1->getId())
        ->and($issue->getResponsible()?->getId())
        ->toBe($user2->getId())
        ->and($issue->getObservers())
        ->toHaveCount(2);
});

it('can create an issue and make transition and add or remove actors and due date', function () {

    /**
     * @var User&ConnectiveContract $user1
     */
    $user1 = User::create(['name' => 'user 1']);
    $user2 = User::create(['name' => 'user 2']);
    $user3 = User::create(['name' => 'user 3']);
    $user4 = User::create(['name' => 'user 4']);

    $data = ['summary' => 'summary', 'description' => 'descr'];

    /**
     * @var AIssue $issue
     */
    $issue = AIssue::create($data);
    $issue->applyWorkflow('simple');

    $issue->setReporter($user1);

    expect()
        ->and($user1->getActingIssues('issue_reporter'))
        ->toHaveCount(1)
        ->and($issue->getReporter()?->getId())
        ->toBe($user1->getId());

    $issue->removeReporter();

    expect()
        ->and($user1->getActingIssues('issue_reporter'))
        ->toHaveCount(0);

    $issue->setResponsible($user2);

    expect()
        ->and($user2->getActingIssues('issue_responsible'))
        ->toHaveCount(1)
        ->and($issue->getResponsible()?->getId())
        ->toBe($user2->getId());

    $issue->removeResponsible();

    expect()
        ->and($user2->getActingIssues('issue_responsible'))
        ->toHaveCount(0);

    $issue->addObserver($user3);
    $issue->addObserver($user4);

    expect()
        ->and($issue->getObservers())
        ->toHaveCount(2);

    $issue->removeObserver($user3);

    expect()
        ->and($issue->getObservers())
        ->toHaveCount(1);

    $issue->removeObserver($user4);

    expect()
        ->and($issue->getObservers())
        ->toHaveCount(0);

    $issue->addObserver($user3);
    $issue->addObserver($user4);

    $issue->removeAllObservers();

    expect()
        ->and($issue->getObservers())
        ->toHaveCount(0);

    $issue->setDueDate(Carbon::today());

    expect()
        ->and($issue->getDueDate()?->format('Y-m-d'))
        ->toEqual(Carbon::today()->format('Y-m-d'));

    $issue->removeDueDate();

    expect()
        ->and($issue->getDueDate())
        ->toBeNull();

    $issue->transitionTo(toState: 'state2', logHistoryTransitionAction: false);

    expect($issue->currentState())->toEqual('state2');

});
