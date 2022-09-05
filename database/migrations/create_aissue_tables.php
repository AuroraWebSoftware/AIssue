<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aissue_issues', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('aissue_issue_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

    }

    public function down(){
        Schema::dropIfExists('aissue_issues');
        Schema::dropIfExists('aissue_issue_types');
    }

};
