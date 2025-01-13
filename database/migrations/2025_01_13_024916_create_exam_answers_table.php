<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_schedule_id')->constrained('exam_schedules');
            $table->foreignId('question_bank_id')->constrained('question_banks');
            $table->foreignId('student_id')->constrained('students');
            $table->string('answer')->nullable();
            $table->boolean('is_flagged')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_answers');
    }
};
