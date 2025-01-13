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
        Schema::create('departement_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departement_id')->constrained('departments');
            $table->string('alias');
            $table->integer('identity');
            $table->integer('grade_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departement_classes');
    }
};
