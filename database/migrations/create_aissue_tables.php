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
            $table->string('model_type');
            $table->bigInteger('model_id');
            $table->bigInteger('assignee_id');
            $table->bigInteger('creater_id');
            $table->string('issue_type');
            $table->string('summary');
            $table->string('description')->nullable();
            $table->bigInteger('priority')->default(1);
            $table->string('status');
            $table->dateTime('duedate')->nullable();
            $table->boolean('archived')->default(false);
            $table->bigInteger('archived_by')->nullable();
            $table->dateTime('archived_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aissue_issues');
    }
};
