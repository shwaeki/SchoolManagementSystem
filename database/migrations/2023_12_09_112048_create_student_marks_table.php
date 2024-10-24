<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_certificate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('certificate_category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('mark')->nullable();
            $table->enum('semester', ['first', 'second']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};
