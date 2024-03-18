<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // todo
        Blueprint::macro('arflow', function (string $workflow = 'workflow', string $state = 'state', string $stateMetadata = 'state_metadata') {
            /**
             * @var Blueprint $this
             */
            $this->string($workflow)->nullable()->index();
            $this->string($state)->nullable()->index();
            $this->json($stateMetadata)->nullable();
        });

        Schema::create('aissue_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->arflow();
            $table->string('summary');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aissue_issues');
    }
};
