<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aissue_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('model_type');
            $table->bigInteger('model_id');
            $table->bigInteger('assignee_id');
            $table->bigInteger('creater_id');
            $table->bigInteger('issue_type_id');
            $table->string('summary');
            $table->string('description');
            $table->bigInteger('priority');
            $table->string('status');
            $table->dateTime('duedate');
            $table->boolean('archived');
            $table->bigInteger('archived_by');
            $table->dateTime('archived_at');
            $table->timestamps();
        });

        Schema::create('aissue_issue_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('workflow');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aissue_issues');
        Schema::dropIfExists('aissue_issue_types');
    }
};
