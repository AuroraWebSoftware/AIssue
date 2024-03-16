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

it('can create an issue with simple workflow and responsible user ', function () {

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

    $this->assertEquals($issue->currentState(), 'state1');
    $this->assertEquals($user1->inverseConnectives(connectionTypes: 'responsible')->count(), 1);
    $this->assertEquals($issue->connectives(connectionTypes: 'responsible')->count(), 1);

});
