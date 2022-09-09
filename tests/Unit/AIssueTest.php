<?php

use AuroraWebSoftware\AIssue\Models\AIssue;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh');
    $this->data = [
        'code' => 'test',
        'model_type' => 'test',
        'model_id' => 1,
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type' => 'test',
        'summary' => 'test',
        'description' => 'test',
        'priority' => 1,
        'status' => 'test',
        'duedate' => '2022-09-08 09:04:15',
        'archived' => true,
        'archived_by' => 'test',
        'archived_at' => '2022-09-08 09:04:15',
    ];

    $this->aissue = new AuroraWebSoftware\AIssue\AIssue();
});

test('can read aissue config', function () {
    $this->assertNotNull(config('aissue'));
});

test('can access policy method', function () {
    $this->assertTrue(config('aissue')['policyMethod'] instanceof \Closure);
});

test('can access policy method works', function () {
    $this->assertTrue(config('aissue')['policyMethod']('test permission'));
});

test('can get one specified issue', function () {
    //AAuth::organizationNodes();
    // todo
    expect(1)->toBeTruthy();
});

test('can create aissue', function () {
    $createdAissue = $this->aissue->createIssue($this->data);
    $this->assertDatabaseHas('aissue_issues', $this->data);
});

test('can make transition', function () {
    $createdAissue = $this->aissue->createIssue($this->data);
    $transition = $this->aissue->makeTransition($createdAissue, 'todo');
    $this->assertTrue($transition->status == 'todo');
});

test('can get transitionable statuses', function () {
    $createdAissue = $this->aissue->createIssue($this->data);
    $transitionableStatuses = $this->aissue->getTransitionableStatuses($createdAissue);
    // $this->assertTrue($transition->status == 'todo');
});
