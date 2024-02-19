<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aissue_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->arflow();
            $table->string('summary');
            $table->string('description')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aissue_issues');
    }
};
