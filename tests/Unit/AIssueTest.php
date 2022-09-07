<?php

use AuroraWebSoftware\AAuth\Models\AIssue;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh');

    $this->aissueData = [
        'id' => 1,
        'code' => '',
        'model_type' => 'test',
        'model_id' => 1,
        'assignee_id' => 1,
        'creater_id' => 1,
        'issue_type_id' => 1,
        'summary' => 'test',
        'description' => 'test',
        'status' => 'true',
        'duedate' => '',
        'archived' => true,
        'archived_by' => 1,
        'archived_at' => '',
    ];
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















