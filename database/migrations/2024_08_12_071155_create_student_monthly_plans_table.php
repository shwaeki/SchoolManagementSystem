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
        Schema::create('student_monthly_plans', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('image')->nullable();
            $table->text('objectives')->nullable();
            $table->text('methods')->nullable();
            $table->string('month');
            $table->foreignId('year_class_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_monthly_plans');
    }
};
