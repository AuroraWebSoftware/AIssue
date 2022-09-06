<?php

use AuroraWebSoftware\AAuth\Models\AIssue;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh');

});

test('passOrAbort', function () {
    expect(1)->toBeTruthy();
});

test('can get one specified issue', function () {
    //AAuth::organizationNodes();
    // todo
    expect(1)->toBeTruthy();
});

it(description: 'stores the data correctly in the database')
    ->tap(
        fn (): AIssue => AIssue::create(
            [
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
            ]
        )
    )->assertDatabaseHas('aissues', [
        'approvalable_type' => 'App\Models\FakeModel',
        'approvalable_id' => 1,
        'state' => ApprovalStatus::Pending,
    ]);













