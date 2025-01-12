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
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('exam_date');
            $table->string('exam_title');
            $table->foreignId('exam_bank_id')->constrained('exam_banks');
            $table->string('grade_level');
            $table->integer('total_question');
            $table->integer('total_time');
            $table->integer('can_be_completed_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};
