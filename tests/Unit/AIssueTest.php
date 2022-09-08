<?php

use AuroraWebSoftware\AIssue\Models\AIssue;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh');
});

test('can create aissue', function () {

    // arrange
    $data = [
        'code'=>'test',
        'model_type'=>'test',
        'model_id'=>1,
        'assignee_id'=>1,
        'creater_id'=>1,
        'issue_type'=>'test',
        'summary'=>'test',
        'description'=>'test',
        'priority'=>1,
        'status'=>'test',
        'duedate'=>'2022-09-08 09:04:15',
        'archived'=>true,
        'archived_by'=>'test',
        'archived_at'=>'2022-09-08 09:04:15',
    ];

    $createdAissue = AuroraWebSoftware\AIssue\AIssue::createIssue($data);

    $isExist = AIssue::where('id','=',$createdAissue->id)->exists();
    $this->assertTrue($isExist);

    //2022-09-08 09:04:15
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
