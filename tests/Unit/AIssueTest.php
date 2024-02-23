<?php

use AuroraWebSoftware\AIssue\Models\AIssue;
use AuroraWebSoftware\AIssue\Tests\Models\User;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use Illuminate\Database\Schema\Blueprint;
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
            'connection_types' => ['participant', 'responsible', 'observer'],
        ],
    );

});

it('can create an issue with simple workflow and responsible user ', function () {

    /**
     * @var User&ConnectiveContract $user1
     */
    $user1 = User::create(['name' => 'user 1']);

    $data = ['summary' => 'summary', 'description' => 'descr'];

    /**
     * @var AIssue $issue
     */
    $issue = AIssue::create($data);
    $issue->applyWorkflow('simple');

    $issue->connectTo($user1, 'responsible');

    $this->assertEquals($issue->currentState(), 'state1');
    $this->assertEquals($user1->inverseConnectives(connectionTypes: 'responsible')->count(), 1);
    $this->assertEquals($issue->connectives(connectionTypes: 'responsible')->count(), 1);

});
