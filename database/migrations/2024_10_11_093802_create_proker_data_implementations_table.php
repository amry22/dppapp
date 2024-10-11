<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proker_data_implementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proker_data_prokers_id')->constrained('proker_data_prokers')->cascadeOnDelete();
            $table->foreignId('division_id')->constrained('data_divisions');
            $table->foreignId('department_id')->nullable()->constrained('data_departments');
            $table->string('name');
            $table->string('target');
            $table->string('timeline');
            $table->string('budget');
            $table->string('budget_source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker_data_implementations');
    }
};
