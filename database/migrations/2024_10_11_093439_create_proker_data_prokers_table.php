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
        Schema::create('proker_data_prokers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('division_id')->constrained('data_divisions');
            $table->foreignId('department_id')->nullable()->constrained('data_departments');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker_data_prokers');
    }
};
