<?php

use AuroraWebSoftware\AIssue\Tests\Models\Issueable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Artisan::call('migrate:fresh');

    Schema::create('issueables', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

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

    $createdModel = Issueable::create(
        ['name' => 'test isuable model 1']
    );

    $createdIssueModel = $createdModel->createIssue(1, 1, 'task', 'test isssue 1', 'asdasd', 1, \Illuminate\Support\Carbon::now());

    $this->assertEquals(
        \AuroraWebSoftware\AIssue\Models\AIssue::where('id', '=', $createdIssueModel->id )->first()->summary,
        $createdIssueModel->summary
    );

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


test('x', function () {


});
