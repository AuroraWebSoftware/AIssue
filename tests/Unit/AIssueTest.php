<?php

use AuroraWebSoftware\AIssue\Exceptions\TransitionPermissionException;
use AuroraWebSoftware\AIssue\Models\AIssue;
use AuroraWebSoftware\AIssue\Tests\Models\Issueable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;


beforeEach(function () {
    Artisan::call('migrate:fresh');

    Schema::create('issueables', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    $mockPolicyFunction = function ($permission): bool {
        if ($permission == 'todo_perm' || $permission == 'in_progress_perm') {
            return true;
        }
        return false;
    };

    Config::set('aissue.policyMethod', $mockPolicyFunction);
});

test('can read aissue config', function () {
    $this->assertNotNull(config('aissue'));
});

test('can access policy method', function () {
    $this->assertTrue(config('aissue')['policyMethod'] instanceof \Closure);
});

test('can access policy method works for todo', function () {
    $this->assertTrue(config('aissue')['policyMethod']('todo_perm'));
});

test('can access policy method works for done', function () {
    $this->assertFalse(config('aissue')['policyMethod']('done_perm'));
});

test('can create aissue for a model using trait', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 1']
    );

    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 1.1', 'asdasd', 1, Carbon::now());

    $this->assertEquals(
        AIssue::where('id', '=', $createdIssueModel->id)->first()->summary,
        $createdIssueModel->summary
    );
});

test('can check make transition for todo using trait', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 2']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdasd', 1, Carbon::now());

    $this->assertTrue($createdIssueModel->canMakeTransition('todo'));
});

test('can check make transition for in_progress using trait', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 3']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdasd', 1, Carbon::now());

    $this->assertTrue($createdIssueModel->canMakeTransition('in_progress'));
});

test('can check make transition for done', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 4']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdasd', 1, Carbon::now());

    $this->assertFalse($createdIssueModel->canMakeTransition('done'));
});

test('can make transition using Issue Model', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 5']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdasd', 1, Carbon::now());

    $transition = $createdIssueModel->makeTransition('in_progress');

    $this->assertTrue($transition->status == 'in_progress');
});

test('cannot make transition using Issue Model without permission', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 5']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdasd', 1, Carbon::now());

    $transition = $createdIssueModel->makeTransition('done');
})->throws(TransitionPermissionException::class);


test('can check get transitionable statuses ', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 4']
    );

    /** @var AIssue $createdIssueModel */
    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 2.1', 'asdasd', 1, Carbon::now());
    $transitionable = $createdIssueModel->getTransitionableStatuses($createdIssueModel);
    $this->assertTrue($transitionable == ['todo', 'in_progress']);
});

test('can create aissue using service class', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 1 service class']
    );

    $aissueService = new AuroraWebSoftware\AIssue\AIssue;

    $data = [
        'model_type' => $createdModel->getAIssueModelType(),
        'model_id' => $createdModel->getAIssueModelId(),
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'task',
        'summary' => 'test isssue service class',
        'description' => 'asdasd',
        'priority' => 1,
        'status' => $createdModel->getAIssueDefaultStatus('task'),
        'duedate' => Carbon::now(),
    ];

    $createdIssueModel = $aissueService->createIssue($data);
    $this->assertEquals(
        AIssue::where('id', '=', $createdIssueModel->id)->first()->summary,
        $createdIssueModel->summary
    );
});

test('can check make transition for todo using service class', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 2 service class']
    );

    $aissueService = new AuroraWebSoftware\AIssue\AIssue;

    $data = [
        'model_type' => $createdModel->getAIssueModelType(),
        'model_id' => $createdModel->getAIssueModelId(),
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'task',
        'summary' => 'test isssue service class',
        'description' => 'asdasd',
        'priority' => 1,
        'status' => $createdModel->getAIssueDefaultStatus('task'),
        'duedate' => Carbon::now(),
    ];

    $createdIssueModel = $aissueService->createIssue($data);

    $this->assertTrue($createdIssueModel->canMakeTransition('todo'));
});

test('can check make transition for in_progress using service class', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 3 service class']
    );

    $aissueService = new AuroraWebSoftware\AIssue\AIssue;

    $data = [
        'model_type' => $createdModel->getAIssueModelType(),
        'model_id' => $createdModel->getAIssueModelId(),
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'task',
        'summary' => 'test isssue service class',
        'description' => 'asdasd',
        'priority' => 1,
        'status' => $createdModel->getAIssueDefaultStatus('task'),
        'duedate' => Carbon::now(),
    ];

    $createdIssueModel = $aissueService->createIssue($data);
    $this->assertTrue($createdIssueModel->canMakeTransition('in_progress'));
});

test('can check make transition for done from service class', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 4 service class']
    );

    $aissueService = new AuroraWebSoftware\AIssue\AIssue;

    $data = [
        'model_type' => $createdModel->getAIssueModelType(),
        'model_id' => $createdModel->getAIssueModelId(),
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'task',
        'summary' => 'test isssue service class',
        'description' => 'asdasd',
        'priority' => 1,
        'status' => $createdModel->getAIssueDefaultStatus('task'),
        'duedate' => Carbon::now(),
    ];

    $createdIssueModel = $aissueService->createIssue($data);
    $this->assertFalse($createdIssueModel->canMakeTransition('done'));
});

test('can make transition using service class', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 5 service class']
    );

    $aissueService = new AuroraWebSoftware\AIssue\AIssue;

    $data = [
        'model_type' => $createdModel->getAIssueModelType(),
        'model_id' => $createdModel->getAIssueModelId(),
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'task',
        'summary' => 'test isssue service class',
        'description' => 'asdasd',
        'priority' => 1,
        'status' => $createdModel->getAIssueDefaultStatus('task'),
        'duedate' => Carbon::now(),
    ];

    $createdIssueModel = $aissueService->createIssue($data);

    $transition = $createdIssueModel->makeTransition('in_progress');

    $this->assertTrue($transition->status == 'in_progress');
});

test('can check get transitionable statuses from service class', function () {
    $createdModel = Issueable::create(
        ['name' => 'test isuable model 4 service class']
    );

    $aissueService = new AuroraWebSoftware\AIssue\AIssue;

    $data = [
        'model_type' => $createdModel->getAIssueModelType(),
        'model_id' => $createdModel->getAIssueModelId(),
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'task',
        'summary' => 'test isssue service class',
        'description' => 'asdasd',
        'priority' => 1,
        'status' => $createdModel->getAIssueDefaultStatus('task'),
        'duedate' => Carbon::now(),
    ];

    $createdIssueModel = $aissueService->createIssue($data);

    $transitionable = $createdIssueModel->getTransitionableStatuses($createdIssueModel);
    $this->assertTrue($transitionable == ['todo', 'in_progress']);
});

// todo all Facade Class tests must be written.
